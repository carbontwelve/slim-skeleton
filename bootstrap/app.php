<?php

require __DIR__.'/../vendor/autoload.php';

define('APP_BASE', realpath(__DIR__.DIRECTORY_SEPARATOR.'..'));

session_start();

// Instantiate the container and inject settings
$container = new \Slim\Container();
$container['settings'] = new \Slim\Collection(require __DIR__.'/../config/app.php');

// Register Service Providers
foreach($container['settings']['services'] as $service) {
    if (is_string($service)) {
        $service = new $service;
    }
    $container->register($service);
}

// Instantiate the app
$app = new \Slim\App($container);

// Register middleware
require __DIR__.'/../app/Http/middleware.php';

// Register routes
require __DIR__.'/../app/Http/routes.php';

return $app;
