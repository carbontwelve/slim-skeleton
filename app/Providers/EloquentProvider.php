<?php

namespace App\Providers;

use App\Http\Controllers\ExampleController;
use Illuminate\Database\Capsule\Manager;
use Interop\Container\ContainerInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Views\PhpRenderer;

class EloquentProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container|ContainerInterface $pimple A container instance
     *
     */
    public function register(Container $pimple)
    {
        $capsule = new Manager();
        $capsule->addConnection($pimple->get('settings')['database']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $pimple['db'] = function () use ($capsule) {
            return $capsule;
        };
    }
}
