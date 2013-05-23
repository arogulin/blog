<?php
$blog = $app['controllers_factory'];

// Main page
$blog->get('/', 'Blog\Controller\IndexController::index')
->value('page', 1)
->bind('main');

// Main page navigation
$blog->get('/page/{page}', 'Blog\Controller\IndexController::index')
->assert('page', '\d+')
->convert('page', function ($page) {
        return intval($page);
    })
->bind('main_pagination');

// Post page
$blog->get('/posts/{slug}', 'Blog\Controller\PostController::show')
->bind('post');

// Add comment to post page
$blog->post('/comments/{postId}/add', 'Blog\Controller\CommentController::add')
->bind('add_comment');


$app->mount('/', $blog);
