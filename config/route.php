<?php
$blog = $app['controllers_factory'];

// Главная страница
$blog->get('/', 'Blog\Controller\IndexController::index')
    ->value('pageNum', 1);

// Навигация
$blog->get('/page/{pageNum}', 'Blog\Controller\IndexController::index')
    ->assert('pageNum', '\d+')
    ->convert('pageNum', function ($pageNum) {
        return intval($pageNum);
    });

// Страница конкретного поста
$blog->get('/posts/{slug}', 'Blog\Controller\PostController::show');

// Добавление комментария к посту
$blog->post('/comments/{postId}/add', 'Blog\Controller\CommentController::add');


$app->mount('/', $blog);
