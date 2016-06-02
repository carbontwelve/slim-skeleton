<?php

namespace App\Providers;

use App\Http\Handlers\NotFoundPageResolver;
use Interop\Container\ContainerInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PageViewRoutingProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container|ContainerInterface $pimple A container instance
     */
    public function register(Container $pimple)
    {
        /** @var \Carbontwelve\SlimPlates\PlatesRenderer $renderer */
        $renderer = $pimple['renderer'];

        $pimple['notFoundHandler'] = function () use ($renderer) {
            return new NotFoundPageResolver($renderer);
        };
    }
}
