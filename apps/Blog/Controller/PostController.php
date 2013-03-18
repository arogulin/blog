<?php
namespace Blog\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PostController {

    public function show(Request $request, Application $app) {
        echo '<pre>';
        var_dump($request->get('slug'));
        echo '</pre>';
        die();
    }
}