<?php

require __DIR__.'/../vendor/autoload.php';

define('APP_BASE', realpath(__DIR__.DIRECTORY_SEPARATOR.'..'));

session_start();

// Instantiate the container
$container = new \Slim\Container();

// Load settings into the container
$container->register(new \App\Providers\SettingsProvider());
$container->register(new \App\Providers\SessionProvider());
$container->register(new \App\Providers\ViewProvider());
$container->register(new \App\Providers\LoggerProvider());
$container->register(new \App\Providers\ControllerProvider());

// Instantiate the app
$app = new \Slim\App($container);

// Register middleware
require __DIR__.'/../app/Http/middleware.php';

// Register routes
require __DIR__.'/../app/Http/routes.php';

// Run app
$app->run();
