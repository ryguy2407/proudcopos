<?php


class boolTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testBoolToString()
    {
        $actual = bool_to_string('0');
        $expect = "No";
        $this->assertEquals($actual, $expect);
    }

}