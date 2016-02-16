<?php
return [
    'displayErrorDetails' => true, // set to false in production
    'determineRouteBeforeAppMiddleware' => false,
    'outputBuffering' => 'append',
    'responseChunkSize' => 4096,
    'httpVersion' => '1.1',

    // Renderer settings
    'renderer' => [
        'template_path' => realpath(__DIR__ . '/../resources/views') . DIRECTORY_SEPARATOR,
    ],

    // Monolog settings
    'logger' => [
        'name' => 'slim-app',
        'path' => realpath(__DIR__ . '/../storage/framework/logs/') . DIRECTORY_SEPARATOR . 'app-'. date('dmY') .'.log'
    ],
];
