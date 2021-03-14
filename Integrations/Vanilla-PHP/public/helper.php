<?php

/**
 * A variant of index.php where we use a singleton Clockwork instance and the clock() helper instead of managing our
 * own Clockwork instance
 */

require __DIR__ . '/../vendor/autoload.php';

use Clockwork\Support\Vanilla\Clockwork;

Clockwork::init([
	'api' => '/clockwork.php?request=',
	'storage_files_path' => __DIR__ . '/clockwork',
	'register_helpers' => true
]);

echo "Hello!";

clock('Hello', 'logging!');

clock()->event('Adding sample Clockwork data.')->name('sample-data')->begin();

clock()->addDatabaseQuery('SELECT * FROM users WHERE id = 1', [ 'id' => 1 ], 0.02, [
	'connection' => 'mysql', 'model' => 'User'
]);

clock()->addCacheQuery('write', 'user', [ 'id' => 1, 'name' => 'Igor Timko' ], 0.005, [
	'connection' => 'redis', 'expiration' => 50
]);

clock()->addEvent('user-logged-in', [ 'userId' => 1 ], microtime(true), [
	'listeners' => [ 'LogUserLogin' ]
]);

clock()->addRoute('POST', '/login', 'login.php', [
	'middleware' => [ 'csrf' ], 'name' => 'login'
]);

clock()->addEmail('User logged in!', 'admin@domain.tld', 'info@domain.tld');

clock()->addView('login.php', [ 'csrfToken' => '123abc' ]);

usleep(5000);

clock()->event('sample-data')->end();

clock()->requestProcessed();

