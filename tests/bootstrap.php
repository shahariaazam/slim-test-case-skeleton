<?php

class SlimFrameworkTestCase extends PHPUnit_Framework_TestCase
{
    private $testingMethods = array('get', 'post', 'patch', 'put', 'delete', 'head');

    // Run for each unit test to setup our slim app environment
    public function setup()
    {

        require_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

        $app = new \Slim\Slim();

        require_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'routes.php';

        $this->app = $app;
    }

    // Abstract way to make a request to SlimPHP, this allows us to mock the
    // slim environment
    private function request($method, $path, $formVars = array(), $optionalHeaders = array())
    {
        ob_start();

        \Slim\Environment::mock(array_merge(array(
            'REQUEST_METHOD' => strtoupper($method),
            'PATH_INFO' => $path,
            'SERVER_NAME' => 'slim.test',
        )));

        $this->response = $this->app->response;
        $this->request = $this->app->request;

        $this->app->run();

// Return the application output. Also available in `response->body()`
        return ob_get_clean();
    }

    public function __call($method, $arguments)
    {
        if (in_array($method, $this->testingMethods)) {
            list($path, $formVars, $headers) = array_pad($arguments, 3, array());
            return $this->request($method, $path, $formVars, $headers);
        }
        throw new \BadMethodCallException(strtoupper($method) . ' is not supported');
    }
}