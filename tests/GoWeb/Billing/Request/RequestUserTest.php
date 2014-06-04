<?php

namespace GoWeb\Billing\Request;

class RemindUserPasswordTest extends \PHPUnit_Framework_TestCase
{
    protected $_factory;
    
    public function setUp()
    {
        $this->_factory = new \GoWeb\Billing('http =>//my/');
    }
    
    public function testSend()
    {
        $this->_factory->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(200, [
                'Content-Type' => 'application/json',
            ], json_encode([
                "error" => 0,
            ]))
        )));
        
        $response = $this->_factory->remindUserPassword()
            ->setEmail('user@server.com')
            ->send();
        
        $this->assertEquals(0, $response->get('error'));
    }
}