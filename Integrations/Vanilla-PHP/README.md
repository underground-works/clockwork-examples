# Vanilla PHP application example

This is an example of integrating Clockwork in a vanilla PHP application.

You can run the example app using the built-in PHP web server:

```
$ composer install
$ php -S 127.0.0.1:8000 -t public
```

The `index.php` file is our PHP application, includes example of initializing a Clockwork instance and adding some sample data.

The `helper.php` file shows a different way to use Clockwork using a `clock()` helper instead of managing your own Clockwork instance.

The `clockwork.php` file implements the Clockwork REST API used by the Clockwork client applications to retrieve request metadata.

Read the [full documentation on the Clockwork website](https://underground.works/clockwork/installation/vanilla?#content).