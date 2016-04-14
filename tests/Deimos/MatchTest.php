<?php

namespace Deimos;

class MatchTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionCurrent()
    {
        $match = new Match('~\d+~', 'hello world');
        $match->current();
    }

    /**
     * @dataProvider providerEqual
     */
    public function testEqual($regexp, $string)
    {
        $match = new Match($regexp, $string);
        preg_match($regexp, $string, $value);
        $this->assertEquals($match->getValue(), $value);
    }

    public function providerEqual()
    {
        return array(
            array('~hello+~', 'hello world'),
            array('~\d+~', 123),
            array('~\w+~', 'hello world'),
            array('~\W+~', 123)
        );
    }

    public function testGet()
    {
        $match = new Match('~\d+~', 1234);
        $this->assertEquals($match->get(0), 1234);

        $match = new Match('~\d~', 1234);
        $this->assertEquals($match->get(0), 1);

        $match = new Match('~\s~', 1234);
        $this->assertEquals($match->get(0), null);
    }

}
