<?php

namespace App\Http\Handlers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Body;
use UnexpectedValueException;

class NotFound extends \Slim\Handlers\NotFound
{
    /**
     * Invoke not found handler
     *
     * @param  ServerRequestInterface $request  The most recent Request object
     * @param  ResponseInterface      $response The most recent Response object
     *
     * @return ResponseInterface
     * @throws UnexpectedValueException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $contentType = $this->determineContentType($request);
        switch ($contentType) {
            case 'application/json':
                $output = $this->renderJsonNotFoundOutput();
                break;

            case 'text/xml':
            case 'application/xml':
                $output = $this->renderXmlNotFoundOutput();
                break;

            case 'text/html':
                if($pageFound = $this->resolvePage($request, $response)) {
                    return $pageFound;
                }

                $output = $this->renderHtmlNotFoundOutput($request);
                break;

            default:
                throw new UnexpectedValueException('Cannot render unknown content type ' . $contentType);
        }

        $body = new Body(fopen('php://temp', 'r+'));
        $body->write($output);

        return $response->withStatus(404)
            ->withHeader('Content-Type', $contentType)
            ->withBody($body);
    }

    private function resolvePage(ServerRequestInterface $request, ResponseInterface $response)
    {
        $requestUri = $request->getUri();
        $requestPath = array_filter(explode('/', $requestUri->getPath()), function($value){
            return (strlen(trim($value)) > 0);
        });

        // If somehow the user has come to an index page via its not-pretty-uri 301 redirect them
        if (end($requestPath) === 'index') {
            array_pop($requestPath);
            $requestPathString = (string) $requestUri->withPath( implode('/', $requestPath));

            // Check first that we are not redirecting to a 404, if the request path is zero length then its safe to assume it exists as a / path
            if(count($requestPath) > 0 && ! $this->pageExists($requestPathString)) {
                return null;
            }

            return $response->withStatus(301)
                ->withHeader('Location', $requestPathString);
        }

        dd($requestPath);

        return null;
    }

    private function pageExists($path)
    {
        
        return false;
    }
}