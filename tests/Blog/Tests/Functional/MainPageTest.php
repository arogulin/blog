<?php
namespace Blog\Tests\Functional;

use Silex\WebTestCase;

class TestMainPage extends WebTestCase {

    public function createApplication() {
        require __DIR__ . '/../../../../config/bootstrap.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }

    public function testMainPage() {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        // Server should answer with 200 HTTP-code
        $this->assertTrue($client->getResponse()->isOk());
        // There are config.pagination.posts_main_page should be
        
    }
}