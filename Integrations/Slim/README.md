# Slim Framework Skeleton Example

This is an example of integrating Clockwork in a Slim Framework Skeleton application.

You can run the example app using the built-in PHP web server:

```
$ composer install
$ php -S 127.0.0.1:8000 -t public
```

## Installation instructions

Create a new Slim skeleton application:

```
composer create-project slim/slim-skeleton .
```

Install Clockwork and the PSR http auto-discovery package:

```
composer require itsgoingd/clockwork php-http/discovery
```

Register the Clockwork middleware with the app, add following to `public/index.php`:

```php
use Clockwork\Support\Vanilla\ClockworkMiddleware;
$app->add(ClockworkMiddleware::init([ 'storage_files_path' => __DIR__ . '/../var/clockwork' ]));
```

Note, because the Slim skeleton project registers the routing middleware as the last (outermost) middleware, you will need to add Clockwork middleware in `public/index.php`, just before the `$app->handle()` call, instead of `app/middleware.php`.

## Alternative options

Instead of using the `php-http/discovery` package, you can explicitly set the response factory like this:

```php
use Clockwork\Support\Vanilla\ClockworkMiddleware;
$app->add(ClockworkMiddleware::init()->withResponseFactory($app->getResponseFactory()));
```

You can disable the routing in the middleware and opt-in to register the Clockwork routes yourself:

```php
use Clockwork\Support\Vanilla\ClockworkMiddleware;
$app->add(ClockworkMiddleware::init()->withoutRouting());

$app->get('/__clockwork/{request:.+}', function ($request, $response) use ($clockwork) {
    return $clockwork->usePsrMessage($request, $response)->handleMetadata();
});
```

You can pass your own Clockwork instance into the middleware:

```php
use Clockwork\Support\Vanilla\Clockwork;
use Clockwork\Support\Vanilla\ClockworkMiddleware;
$clockwork = new Clockwork([ ... ]);
$app->add(new ClockworkMiddleware($clockwork));
```

Note, the `clock()` helper will work only when Clockwork or the middleware is instantiated via the `init` method.



# Slim Framework 4 Skeleton Application

[![Coverage Status](https://coveralls.io/repos/github/slimphp/Slim-Skeleton/badge.svg?branch=master)](https://coveralls.io/github/slimphp/Slim-Skeleton?branch=master)

Use this skeleton application to quickly setup and start working on a new Slim Framework 4 application. This application uses the latest Slim 4 with Slim PSR-7 implementation and PHP-DI container implementation. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application. You will require PHP 7.4 or newer.

```bash
composer create-project slim/slim-skeleton [my-app-name]
```

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writable.

To run the application in development, you can run these commands 

```bash
cd [my-app-name]
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
cd [my-app-name]
docker-compose up -d
```
After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

That's it! Now go build something cool.
