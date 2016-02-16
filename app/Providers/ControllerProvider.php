<?php

namespace App\Providers;

use App\Http\Controllers\ExampleController;
use Interop\Container\ContainerInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Views\PhpRenderer;

class ControllerProvider implements ServiceProviderInterface
{
    /** @var array  */
    private $controllers = [];

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
        $this->registerControllers($pimple);
        /**
         * @var string
         * @var \App\Http\Controllers\BaseController $controller
         */
        foreach ($this->controllers as $id => $controller) {
            $controller->setContainer($pimple);
            $pimple[$id] = $controller;
        }
    }

    /**
     * @param Container $pimple
     */
    private function registerControllers(Container $pimple)
    {
        $this->controllers['App\Http\Controllers\ExampleController'] = new ExampleController();
    }
}
