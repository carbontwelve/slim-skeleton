<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExampleMiddleware
{
    /**
     * ExampleMiddleware constructor.
     */
    public function __construct()
    {
        // ...
    }

    /**
     * Example middleware invokable class.
     *
     * @param ServerRequestInterface $request  PSR7 request
     * @param ResponseInterface      $response PSR7 response
     * @param callable               $next     Next middleware
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        // Continue to the next item in the middleware stack
        return $next($request, $response);
    }
}
