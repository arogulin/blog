<?php
namespace Blog\Repository;

use Blog\Collection\CommentsCollection;
use Blog\Entity\Comment;
use Silex\Application;

class CommentsRepository {

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function getList($postId) {
        $postId = intval($postId);

        $query = "
            SELECT * 
            FROM `comments` 
            WHERE
                `post_id` = ?
                AND `status` = ? 
            ORDER BY `date`";

        $commentsRows = $this->app['db']->fetchAll($query, array($postId, Comment::STATUS_MODERATED));

        if (!$commentsRows) {
            return false;
        }

        $comments = new CommentsCollection($commentsRows);

        return $comments;
    }

    public function countComments($postId) {
        $postId = intval($postId);

        $query = "
            SELECT COUNT(*) 
            FROM `comments` 
            WHERE
                `post_id` = ?
                AND `status` = ?";

        $count = intval($this->app['db']->fetchColumn($query, array($postId, Comment::STATUS_MODERATED)));

        return $count;
    }
}