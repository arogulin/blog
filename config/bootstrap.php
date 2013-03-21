<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/route.php';

return $app;