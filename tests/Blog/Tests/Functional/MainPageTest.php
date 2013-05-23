<?php
namespace Blog\Tests\Functional;

use Silex\WebTestCase;

class TestMainPage extends WebTestCase {

    public function createApplication() {
        require ROOT_DIR . '/config/bootstrap.php';
        $app['debug'] = true;

        // TODO: init DB with some pages of posts, for pagination testing

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

        $crawler = $client->request('GET', '/page/2');
        $this->assertTrue($client->getResponse()->isOk());

        // TODO: check that posts are not equal and count of posts is as expected

        $crawler = $client->request('GET', '/page/20');
        $this->assertTrue($client->getResponse()->isNotFound());
    }
}