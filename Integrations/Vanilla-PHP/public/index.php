<?php

require __DIR__ . '/../vendor/autoload.php';

use Clockwork\Support\Vanilla\Clockwork;

$clockwork = Clockwork::init([
	'api' => '/clockwork.php?request=',
	'storage_files_path' => __DIR__ . '/clockwork'
]);

echo "Hello!";

$clockwork->event('Adding sample Clockwork data.')->name('sample-data')->begin();

$clockwork->addDatabaseQuery('SELECT * FROM users WHERE id = 1', [ 'id' => 1 ], 0.02, [
	'connection' => 'mysql', 'model' => 'User'
]);

$clockwork->addCacheQuery('write', 'user', [ 'id' => 1, 'name' => 'Igor Timko' ], 0.005, [
	'connection' => 'redis', 'expiration' => 50
]);

$clockwork->addEvent('user-logged-in', [ 'userId' => 1 ], microtime(true), [
	'listeners' => [ 'LogUserLogin' ]
]);

$clockwork->addRoute('POST', '/login', 'login.php', [
	'middleware' => [ 'csrf' ], 'name' => 'login'
]);

$clockwork->addEmail('User logged in!', 'admin@domain.tld', 'info@domain.tld');

$clockwork->addView('login.php', [ 'csrfToken' => '123abc' ]);

usleep(5000);

$clockwork->event('sample-data')->end();

$clockwork->requestProcessed();

