<?php
namespace Blog\Controller;

use Blog\Repository\CommentsRepository;
use Blog\Repository\PostsRepository;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PostController {

    public function show(Request $request, Application $app) {
        $slug = $request->get('slug');
        $postsRepo = new PostsRepository($app);
        $post = $postsRepo->findBySlug($slug);

        if (!$post) {
            $app->abort(404, "This post does not exist.");
        }

        $commentsRepo = new CommentsRepository($app);
        $comments = $commentsRepo->getList($post['id']);
        $post['comments'] = $comments;

        return $app['twig']->render('post.twig', array('post' => $post));
    }
}