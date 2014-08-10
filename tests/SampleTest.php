<?php
class SampleTest extends SlimFrameworkTestCase
{
    /**
     * THIS TEST IS BEING PASSED
     */
    function testRouteGetRequest()
    {
        $this->get('/hello/shaharia');
        $this->assertEquals('Hello, shaharia', $this->response->body());
    }

    /**
     *      ##### PHPUNIT ERROR #####
     *      PHPUnit_Framework_ExpectationFailedException : Failed asserting that 404 matches expected 200.
     *      Expected :200
     *      Actual   :404
     */
    function testRouteGetRequestbyStatus()
    {
        $this->get('/hello/shaharia');
        $this->assertEquals(200, $this->response->status());
    }
}