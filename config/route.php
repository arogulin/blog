<?php
$blog = $app['controllers_factory'];

// Главная страница
$blog->get('/', 'Blog\Controller\IndexController::index')
    ->value('page', 1)
    ->bind('main');

// Навигация
$blog->get('/page/{page}', 'Blog\Controller\IndexController::index')
    ->assert('page', '\d+')
    ->convert('page', function ($page) {
        return intval($page);
    })
    ->bind('main_pagination');

// Страница конкретного поста
$blog->get('/posts/{slug}', 'Blog\Controller\PostController::show')
    ->bind('post');

// Добавление комментария к посту
$blog->post('/comments/{postId}/add', 'Blog\Controller\CommentController::add')
    ->bind('add_comment');


$app->mount('/', $blog);
