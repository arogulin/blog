<?php
namespace Blog\Tests\Functional;

use Silex\WebTestCase;
use Symfony\Component\CssSelector\CssSelector;
use Symfony\Component\DomCrawler\Crawler;

class TestPostPage extends WebTestCase {

    public function createApplication() {
        require ROOT_DIR . '/config/bootstrap.php';
        $app['debug'] = true;

        // TODO: init DB with some pages of posts, for pagination testing

        return $app;
    }

    public function testCommentsExists() {
        $client = $this->createClient();

        // Get main page
        $crawler = $client->request('GET', '/');
        // Choose one of posts with existed comments
        $posts = $crawler->filter('div.post');
        foreach ($posts as $post) {
            $crawlerPost = new Crawler($post, '/');
            // Save comments count
            $commentsCount = intval($crawlerPost->filter('div.comments span.comments_count')->text());
            if ($commentsCount) {
                // Found post with comments. Now go to this post page
                $postLink = $crawlerPost->filter('.title a')->attr('href');
                break;
            }
        }
        if (!isset($postLink)) {
            $this->fail('No one post with comment has been found on the main page');
        }

        // Go to post page
        $postPageCrawler = $client->request('GET', $postLink);

        // Server should answer with 200 HTTP-code
        $this->assertTrue($client->getResponse()->isOk());

        // Calculate comment count and compare with saved
        $this->assertCount($commentsCount, $postPageCrawler->filter('div.comments div.comment'));
    }
}