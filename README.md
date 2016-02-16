# Slim Skeleton
[![styleci](https://styleci.io/repos/51846155/shield)]()

A rather opinionated skeleton project for getting started with your slim applications. It is heavily inspired by Laravels directory structure, so if you have used Laravel 5 you should feel familiar with this.

## Getting started
The easiest method for getting started developing with the Slim3 Skeleton is via the composer `create-project` command:
`composer create-project --prefer-dist carbontwelve/slim-skeleton app`

Once installed you can use the built in php server with the `serve.php` helper to run the app in your browser:
`php -S 127.0.0.1:8080 serve.php`

## Roadmap
I found myself needing a simple, yet opinionated, skeleton project to build out other applications using Slim3. For larger projects I tend to go for Laravel5 and so the folder structure is heavily inspired by that framework.

Eventually this skeleton will include the following:

- [ ] Command line tool (alla Laravels `artisan`)
- [ ] Optional Whoops error handler service provider
- [ ] Prettier var_dump for the `dd()` method
- [ ] HTTP Basic Auth middleware
- [ ] JWT Auth middleware
