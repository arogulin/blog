<?php
namespace Blog\Entity;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Post {

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function findBySlug($slug) {
        $query = "SELECT * FROM `posts` WHERE `status` = ? AND `slug` = ?";
        $post = $this->app['db']->fetchAssoc($query, array('public', $slug));
        return $post;
    }
}