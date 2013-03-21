<?php
namespace Blog\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController {

    public function index(Request $request, Application $app) {
        return 'Hello!';
    }
}