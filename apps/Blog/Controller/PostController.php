<?php
namespace Blog\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PostController {

    public function show(Request $request, Application $app) {
        $slug = $request->get('slug');
        $query = "SELECT * FROM `posts` WHERE `slug` = ? AND `status` = ?";
        $post = $app['db']->fetchAssoc($query, array($slug, 'public'));
        echo '<pre>';
        var_dump($post);
        echo '</pre>';
        die();
    }
}