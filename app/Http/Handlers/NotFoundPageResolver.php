<?php

namespace App\Http\Handlers;

use Carbontwelve\SlimPlates\PlatesRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Body;
use UnexpectedValueException;

class NotFoundPageResolver extends \Slim\Handlers\NotFound
{

    /**
     * @var PlatesRenderer
     */
    private $platesRenderer;

    /**
     * NotFoundPageResolver constructor.
     * @param PlatesRenderer $platesRenderer
     */
    public function __construct(PlatesRenderer $platesRenderer)
    {
        $this->platesRenderer = $platesRenderer;
    }

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
            if(count($requestPath) > 0 && ! $this->pageExists($requestPath)) {
                return null;
            }

            return $response->withStatus(301)
                ->withHeader('Location', $requestPathString);
        }

        if ($viewPath = $this->resolvePageViewPath($requestPath)) {
            return $this->platesRenderer->render($response, $viewPath);
        }

        return null;
    }

    private function resolvePageViewPath($path)
    {
        // Do not allow access to view files beginning with an underscore in the filename
        foreach($path as $item) {
            if ( substr($item, 0 ,1) === '_' ){
                return null;
            }
        }
        unset($item);

        $platesEngine = $this->platesRenderer->getEngine();

        // Check if path is a directory and if it is, check for an index view file
        $filesystemPath = $platesEngine->getDirectory() . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $path);

        if (file_exists($filesystemPath) && is_dir($filesystemPath) && $platesEngine->exists( 'pages/' . implode('/', $path) . '/index' )) {
            return 'pages/' . implode('/', $path) . '/index';
        }

        // Else simply check to see if the view exists
        if ($platesEngine->exists( 'pages/' . implode('/', $path))){
            return 'pages/' . implode('/', $path);
        }

        return null;
    }
}