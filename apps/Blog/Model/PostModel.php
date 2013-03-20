<?php
namespace Blog\Model;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PostModel {
    public function show(Request $request, Application $app) {
        $app['db']->fetchAssoc();
    }
}