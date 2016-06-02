# Slim Skeleton
[![styleci](https://styleci.io/repos/51846155/shield)](https://styleci.io/repos/51846155)
[![Dependency Status](https://www.versioneye.com/user/projects/56c4a26118b271003b3922aa/badge.svg?style=flat)](https://www.versioneye.com/user/projects/56c4a26118b271003b3922aa)
[![Latest Version](https://img.shields.io/packagist/v/carbontwelve/slim-skeleton.svg?style=flat-square)](https://github.com/carbontwelve/slim-skeleton/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![ghit.me](https://ghit.me/badge.svg?repo=carbontwelve/slim-skeleton)](https://ghit.me/repo/carbontwelve/slim-skeleton)

A rather opinionated skeleton project for getting started with your slim applications. It is heavily inspired by Laravels directory structure, so if you have used Laravel 5 you should feel familiar with this.

## Getting started
The easiest method for getting started developing with the Slim3 Skeleton is via the composer `create-project` command:
`composer create-project -s dev --prefer-dist carbontwelve/slim-skeleton app`

Using `npm install` will pull in all the node requirements for the gulpfile to run, the gulpfile has serveral helper methods for building js and css from the resource folder as well as a file watcher to build on demand while you code.

## Development
Once installed you can use the built in php server with the `serve.php` helper to run the app in your browser:
`php -S 127.0.0.1:8080 -t public serve.php`

## Basic page "router" usage
The Slim Skeleton extends the Slim3 `\Slim\Handlers\NotFound` handler class with `App\Http\Handlers\NotFoundPageResolver` which checks to see if the uri path can be resolved to a view inside the path `resources\views\pages`. 

It will first check to see if the uri path is a directory and if so then check to see if there is a index.phtml within it; this means that `http://example.com/item-one/item-two` will first attempt to resolve to `resources\views\pages\item-one\item-two\index.phtml`. 

If the first check fails it will then see if the view file exists directly, in the case of the previous example it would then attempt to resolve to `resources\views\pages\item-one\item-two.phtml`.

If both checks fail it passes through to the default Slim3 `renderHtmlNotFoundOutput` method.

With this simple functionality you can build quite complex websites without having to configure any granular routes!

## Roadmap
I found myself needing a simple, yet opinionated, skeleton project to build out other applications using Slim3. For larger projects I tend to go for Laravel5 and so the folder structure is heavily inspired by that framework.
