<?php

namespace GoWeb\Billing\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected $_factory;
    
    public function setUp()
    {
        $this->_factory = new \GoWeb\Billing('http://my/');
    }
    
    public function testSend()
    {
        $request = $this->_factory->register(array(
            'email'     => 'user@server.com',
            'password'  => '==password==',
        ));
        
        $request->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(200, [
                'Content-Type' => 'application/json',
            ], json_encode([
                "error" => 0,
            ]))
        )));
        
        $response = $request->send();
        
        $this->assertEquals(0, $response->get('error'));
    }
}