<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

require_once __DIR__ . '/../apps/Blog/Config/config.php';
require_once __DIR__ . '/../apps/Blog/Config/route.php';

$app->run();