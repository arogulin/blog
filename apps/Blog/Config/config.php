<?php
define('ROOT_DIR', __DIR__ . '/../../..');

// Doctrine
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'saitovod',
        'user'     => 'saitovod',
        'password' => 'saitovod',
        'charset'  => 'utf8',
    ),
));