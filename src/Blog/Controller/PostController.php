<?php
namespace Blog\Controller;

use Blog\Entity\Post;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PostController {

    public function show(Request $request, Application $app) {
        $slug = $request->get('slug');
        $postEntity = new Post($app);
        $post = $postEntity->findBySlug($slug);

        if (!$post) {
            $app->abort(404, "This post does not exist.");
        }

        return $app['twig']->render('post.twig', array('post' => $post));
    }
}