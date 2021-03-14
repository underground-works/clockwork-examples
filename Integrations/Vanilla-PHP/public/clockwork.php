<?php

/**
 * Clockwork REST API endpoint, serves the response data to the Clockwork client apps
 */

require __DIR__ . '/../vendor/autoload.php';

use Clockwork\Support\Vanilla\Clockwork;

$clockwork = Clockwork::init([
	'storage_files_path' => __DIR__ . '/clockwork'
]);

$clockwork->handleMetadata();
