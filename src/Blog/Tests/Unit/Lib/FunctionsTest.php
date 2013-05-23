<?php
namespace Blog\Tests\Unit\Lib;

use Blog\Lib\Functions;
use Silex\WebTestCase;

class TestFunctions extends WebTestCase {

    public function createApplication() {
        require __DIR__ . '/../../../../../config/bootstrap.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }

    public function testSlugify() {
        $strings = array(
            'This is test post'                       => 'this-is-test-post',
            ' Some more   spaces '                    => 'some-more-spaces',
            'There are da-sh-es- here!'               => 'there-are-da-sh-es-here',
            'Don\'t need to be the brand-new Hi\'-Fi' => 'don-t-need-to-be-the-brand-new-hi-fi',
            'Too---much--- dashes'                    => 'too-much-dashes',
            '   '                                     => '',
            ' '                                       => '',
            ''                                        => '',
            '[]\';"".,/.,word&%^#@$@!()_+ -'          => 'word',
            'Заголовок сообщения №1'                  => 'zagolovok-soobscheniya-1'
        );

        foreach ($strings as $string => $expected) {
            $this->assertEquals($expected, Functions::slugify($string));
        }
    }

    public function testCamelCase() {
        $strings = array(
            'get_this_string' => 'getThisString',
            'set_this_string' => 'setThisString',
            'copy'            => 'copy'
        );

        foreach ($strings as $string => $expected) {
            $this->assertEquals($expected, Functions::toCamelCase($string));
            $this->assertEquals($string, Functions::fromCamelCase($expected));
        }
    }
}