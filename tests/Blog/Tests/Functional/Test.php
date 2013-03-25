<?php
namespace Blog\Tests\Functional;

use Silex\WebTestCase;

class Test extends WebTestCase {

    public function createApplication() {
        require __DIR__ . '/../../../../config/bootstrap.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }

    public function testMainPage() {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
    }
}