<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

// require (not require_once) need for functional tests, because these files run multiple times
require __DIR__ . '/config.php';
require __DIR__ . '/route.php';

return $app;