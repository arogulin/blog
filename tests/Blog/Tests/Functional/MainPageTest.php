<?php
namespace Blog\Tests\Functional;

use Silex\WebTestCase;

class TestMainPage extends WebTestCase {
    
    public function createApplication() {
        require ROOT_DIR . '/config/bootstrap.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();
        
        return $app;
    }

    public function testMainPage() {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        // Server should answer with 200 HTTP-code
        $this->assertTrue($client->getResponse()->isOk());
    }

    public function testMainPagePagination() {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        // There are config.pagination.posts_main_page should be
        $expectedPostsCount = $this->app['config']['pagination']['posts_main_page'];
        $this->assertCount($expectedPostsCount, $crawler->filter('div.post'));
    }
}