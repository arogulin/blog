<?php
namespace Blog\Repository;

use Blog\Entity\BaseCollection;
use Silex\Application;
use Blog\Entity\Post;

class PostsRepository {

    public function __construct(Application $app) {
        $this->app = $app;
    }

    /**
     * @param int $limit  Count of posts
     * @param int $offset How much posts to skip
     * @internal param int $page
     * @return mixed
     */
    public function getRecent($limit = 10, $offset = 0) {
        $limit = intval($limit);
        $offset = intval($offset);

        $query = "
            SELECT SQL_CALC_FOUND_ROWS * 
            FROM `posts` 
            WHERE `status` = ? 
            ORDER BY `date` DESC LIMIT " . $offset . ", " . $limit;

        $postsRows = $this->app['db']->fetchAll($query, array('public'));
        $foundRows = $this->app['db']->fetchColumn("SELECT FOUND_ROWS()");

        $posts = new BaseCollection();
        foreach ($postsRows as $postRow) {
            $posts->append(new Post($postRow));
        }
        $posts->setFoundRows($foundRows);

        return $posts;
    }

    public function findBySlug($slug) {
        $query = "SELECT * FROM `posts` WHERE `status` = 'public' AND `slug` = ?";
        $post = $this->app['db']->fetchAssoc($query, array($slug));

        return $post;
    }

}