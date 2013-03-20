<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/route.php';

$app->run();