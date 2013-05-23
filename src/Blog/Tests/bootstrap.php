<?php
use Blog\Tests\Fixtures\FixturesLoader;

define('ROOT_DIR', realpath(__DIR__ . '/../../..'));

require ROOT_DIR . '/config/bootstrap.php';

$fixturesLoader = new FixturesLoader($app);
$fixturesLoader->loadPosts();