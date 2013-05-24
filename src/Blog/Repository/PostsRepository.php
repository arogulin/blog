<?php
namespace Blog\Repository;

use Blog\Collection\PostsCollection;
use Blog\Entity\Post;
use Silex\Application;

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

        if (!$postsRows) {
            return false;
        }

        $posts = new PostsCollection($postsRows);
        $posts->setFoundRows($foundRows);

        return $posts;
    }

    public function findBySlug($slug) {
        $query = "SELECT * FROM `posts` WHERE `status` = 'public' AND `slug` = ?";
        $postRow = $this->app['db']->fetchAssoc($query, array($slug));

        if (!$postRow) {
            return false;
        }

        $post = new Post($postRow);

        return $post;
    }

}