<?php

/** @var \Slim\App $app */
$app = require_once __DIR__.'/bootstrap/app.php';

/** @var  $console */
$console = $app->getContainer()->get('console');
