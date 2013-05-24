<?php
namespace Blog\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Blog\Repository\PostsRepository;
use Blog\Repository\CommentsRepository;

class IndexController {

    public function index(Request $request, Application $app) {
        $page = $request->get('page', 1);
        $limit = $app['config']['pagination']['posts_main_page'];
        $offset = ($page > 1) ? ($page - 1) * $limit : 0;

        $postsRepo = new PostsRepository($app);
        $posts = $postsRepo->getRecent($limit, $offset);

        // If requested non existed page
        if (!$posts) {
            return $app->abort(404);
        }

        $commentsRepo = new CommentsRepository($app);
        foreach ($posts as $post) {
            $post->setCommentsCount($commentsRepo->countComments($post['id']));
        }


        // TODO: slice post content by words, not by symbols. Think about Twig extension.

        $pagination = array();
        if ($posts->getFoundRows() > $limit) {
            $pagesQuantity = ceil($posts->getFoundRows() / $limit);
            $pagination = array(
                'current_page'   => $page,
                'pages_quantity' => $pagesQuantity,
                'near_pages'     => $app['config']['pagination']['near_pages'],
                'route_name'     => 'main_pagination',
            );
        }

        return $app['twig']->render('posts.twig', array('posts' => $posts, 'pagination' => $pagination));
    }
}