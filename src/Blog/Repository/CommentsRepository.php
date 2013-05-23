<?php
namespace Blog\Repository;

use Blog\Entity\BaseCollection;
use Silex\Application;
use Blog\Entity\Comment;

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

        $comments = new BaseCollection();
        foreach ($commentsRows as $commentRow) {
            $comments->append(new Comment($commentRow));
        }

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