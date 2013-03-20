<?php
define('ROOT_DIR', __DIR__ . '/..');

$app->register(new Igorw\Silex\ConfigServiceProvider(ROOT_DIR . "/config/settings.yml"));

// Doctrine
$app->register(new Silex\Provider\DoctrineServiceProvider(), $app['config']['database']);
