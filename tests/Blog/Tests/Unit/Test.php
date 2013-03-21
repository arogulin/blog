<?php
namespace Blog\Tests\Unit;

class Test extends \PHPUnit_Framework_TestCase {

    public function bootstrap() {
        require __DIR__ . '/../../../../web/index.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }

    public function testMainPage() {
        $this->assertTrue(true);
    }
}