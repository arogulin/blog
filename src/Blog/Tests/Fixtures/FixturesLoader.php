<?php
namespace Blog\Tests\Fixtures;

use Blog\Lib\Functions;
use Silex\Application;

class FixturesLoader {

    protected $app;

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function loadPosts($postsCount = 100) {
        $postStatuses = array('public', 'private', 'draft');
        $commentsCountRange = array(0, 30); // min, max
        $commentStatuses = array('moderated', 'not_moderated', 'deleted');
        $authorsNames = array(
            'Nikolay', 'Mr. Sun', 'Vasily Petrov', 'Aleksey Aleksandrovich', 'Barsik',
            'Strange dolphin', 'Bambarbiya', 'John Smith'
        );

        // Generate posts

        $postsForComments = array();
        $values = array();
        for ($i = 1; $i <= $postsCount; $i++) {
            $title = 'This is test post title #' . $i;
            $slug = Functions::slugify($title);
            $date = date('Y-m-d H:i:s', mktime(rand(0, 23), rand(0, 59), rand(0, 59), rand(1, 12), rand(1, 29), 2013));
            $content = implode(' ', array_fill(0, rand(3, 100), 'Lorem ipsum dolor sur sit amet.'));
            $status = $postStatuses[array_rand($postStatuses)];
            if ($status == 'public') {
                $postsForComments[] = $i;
            }
            $values[] = "'$title', '$slug', '$date', '$content', '$status'";
        }
        $query = "INSERT INTO `posts` (`title`, `slug`, `date`, `content`, `status`) VALUES (" . (implode('),(',
                $values)) . ")";

        $this->app['db']->executeQuery("TRUNCATE `posts`");
        $this->app['db']->executeQuery($query);


        // Generate comments for 'public' posts

        $values = array();
        foreach ($postsForComments as $postId) {
            if (rand(0, 3) == 3) {
                // 25% of posts will be without comments
                continue;
            }
            $commentsCount = rand($commentsCountRange[0], $commentsCountRange[1]);
            for ($i = 0; $i < $commentsCount; $i++) {
                $authorName = $authorsNames[array_rand($authorsNames)];
                $authorIp = rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(0, 255);
                $date = date('Y-m-d H:i:s', mktime(rand(0, 23), rand(0, 59), rand(0, 59), rand(1, 12), rand(1, 29), 2013));
                $content = implode(' ', array_fill(0, rand(1, 10), 'This is tet content for comment. Thank you!'));
                $status = $commentStatuses[array_rand($commentStatuses)];
                $values[] = "'$postId', '$authorName', '$authorIp', '$date', '$content', '$status'";
            }
        }
        $query = "
            INSERT INTO `comments` (`post_id`, `author_name`, `author_ip`, `date`, `content`, 
            `status`) VALUES (" . (implode('),(', $values)) . ")
        ";

        $this->app['db']->executeQuery("TRUNCATE `comments`");
        $this->app['db']->executeQuery($query);
    }

}




