<?php
// Path to root dir of project
if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', realpath(__DIR__ . '/..'));
}

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Loader\YamlFileLoader;


// Import settings.yml to $app
$app->register(new Igorw\Silex\ConfigServiceProvider(ROOT_DIR . "/config/settings.yml"));

// Register Monolog for Doctrine logging
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => ROOT_DIR . '/logs/dev.log'
));

// Register Doctrine and set db.options from settings.yml
$app->register(new Silex\Provider\DoctrineServiceProvider(), $app['config']['database']);
if ($app['debug']) {
    $logger = new Doctrine\DBAL\Logging\DebugStack();
    $app['db.config']->setSQLLogger($logger);
    $app->error(function (\Exception $e, $code) use ($app, $logger) {
        if ($e instanceof PDOException and count($logger->queries)) {
            // We want to log the query as an ERROR for PDO exceptions!
            $query = array_pop($logger->queries);
            $app['monolog']->err($query['sql'], array(
                'params' => $query['params'],
                'types'  => $query['types']
            ));
        }
    });
    $app->after(function (Request $request, Response $response) use ($app, $logger) {
        // Log all queries as DEBUG.
        foreach ($logger->queries as $query) {
            $app['monolog']->debug($query['sql'], array(
                'params' => $query['params'],
                'types'  => $query['types']
            ));
        }
    });
}

// Register UrlGenerator for url generation (f.e. in pagination)
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Register Twig template engine
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'    => ROOT_DIR . '/src/Blog/Templates',
    'twig.options' => array('cache' => ROOT_DIR . '/cache/twig'),
));
$filter = new \Twig_SimpleFilter('word_wrap', array('Blog\Lib\Functions', 'wrapContentToWord'));

// Register translation
$app->register(new Silex\Provider\TranslationServiceProvider());
$app['translator'] = $app->share($app->extend('translator', function ($translator, $app) {
    $locale = $app['locale'];
    $translator->addLoader('yaml', new YamlFileLoader());
    $translator->addResource('yaml', ROOT_DIR . '/src/Blog/Locales/' . $locale . '.yml', $locale);
    return $translator;
}));

// We can add filter only after all $app->register calls
$app['twig']->addFilter($filter);
