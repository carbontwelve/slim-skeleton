<?php
// Application routes

$app->get('/', 'App\Http\Controllers\ExampleController:index')
    ->setName('home');
