<?php

namespace App\Providers;

use App\Http\Handlers\NotFound;
use Interop\Container\ContainerInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Views\PhpRenderer;

class PageViewRoutingProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container|ContainerInterface $pimple A container instance
     *
     * @return PhpRenderer
     */
    public function register(Container $pimple)
    {
        $pimple['notFoundHandler'] = function () {
            return new NotFound();
        };
    }
}