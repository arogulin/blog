<?php
$blog = $app['controllers_factory'];

// Главная страница
$blog->get('/', 'Blog\Controller\IndexController::index')
    ->value('page', 1);

// Навигация
$blog->get('/page/{page}', 'Blog\Controller\IndexController::index')
    ->assert('page', '\d+')
    ->convert('page', function ($page) {
        return intval($page);
    });

// Страница конкретного поста
$blog->get('/posts/{slug}', 'Blog\Controller\PostController::show');

// Добавление комментария к посту
$blog->post('/comments/{postId}/add', 'Blog\Controller\CommentController::add');


$app->mount('/', $blog);
