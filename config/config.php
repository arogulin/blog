<?php
// Path to root dir of project
define('ROOT_DIR', __DIR__ . '/..');

// Import settings.yml to $app
$app->register(new Igorw\Silex\ConfigServiceProvider(ROOT_DIR . "/config/settings.yml"));

// Register Doctrine and set db.options from settings.yml
$app->register(new Silex\Provider\DoctrineServiceProvider(), $app['config']['database']);
