<?php

return [
    'debug'         => true,
    'whoops.editor' => 'sublime', // Support click to open editor

    'displayErrorDetails'               => true, // set to false in production
    'determineRouteBeforeAppMiddleware' => false,
    'outputBuffering'                   => 'append',
    'responseChunkSize'                 => 4096,
    'httpVersion'                       => '1.1',

    // Renderer settings
    'renderer' => [
        'template_path' => realpath(__DIR__.'/../resources/views'),
        'template_ext'  => 'phtml',
    ],

    // Monolog settings
    'logger' => [
        'name' => 'slim-app',
        'path' => realpath(__DIR__.'/../storage/framework/logs/').DIRECTORY_SEPARATOR.'app-'.date('dmY').'.log',
    ],

    // Database settings
    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => '',
        'username' => '',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ],

    // Services
    'services' => [
        \App\Providers\SessionProvider::class,
        \App\Providers\EloquentProvider::class,
        \App\Providers\ViewProvider::class,
        \App\Providers\LoggerProvider::class,
        \App\Providers\ControllerProvider::class,
        \App\Providers\PageViewRoutingProvider::class,
    ],
];
