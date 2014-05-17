<?php

namespace GoWeb\Billing\Request;

class CreateClientBaseServiceTest extends \PHPUnit_Framework_TestCase
{    
    protected $_factory;
    
    public function setUp()
    {
        $this->_factory = new \GoWeb\Billing('http://my/');
    }
    
    public function testSend()
    {
        $request = $this->_factory->createClientBaseService();
        $request->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(200, null, json_encode([
                "error" => 0,
                "service" => [
                    "id" => 45570,
                    "service_id" => 222,
                    "name" => "Домашний",
                    "custom_name" => "333",
                    "cost" => 0.033,
                    "total_cost" => 0.033,
                    "status" => "ACTIVE",
                    "catchup" => 1,
                    "ad" => 0
                ]
            ]))
        )));
        
        $response = $request
            ->setClientId(111)
            ->setServiceId(222)
            ->setCustomName('333')
            ->send();
        
        $this->assertNotEmpty($response->get('service'));
        
        $this->assertEquals(45570, $response->get('service.id'));
    }
}