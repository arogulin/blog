<?php
namespace Blog\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController {

    public function index(Request $request, Application $app) {
        echo '<pre>';
        var_dump($request->get('pageNum'));
        echo '</pre>';
        die();
    }
}