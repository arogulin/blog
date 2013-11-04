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

        $data = array(
            'name'  => 'Your name',
            'email' => 'Your email',
        );
        $form = $app['form.factory']->createBuilder('form', $data)
                ->add('name')
                ->add('email')
                ->add('gender', 'choice', array(
                'choices'  => array(1 => 'male', 2 => 'female'),
                'expanded' => true,
            ))
                ->getForm();

        return $app['twig']->render('post.twig', array('post' => $post, 'form' => $form->createView()));
    }

    public function addComment(Request $request, Application $app) {
        echo '<pre>';
        var_dump($request);
        echo '</pre>';
        die();
    }
}