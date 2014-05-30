<?php

namespace GoWeb\Billing\Request;

class CreateClientAdditionalServiceTest extends \PHPUnit_Framework_TestCase
{    
    protected $_factory;
    
    public function setUp()
    {
        $this->_factory = new \GoWeb\Billing('http://my/');
    }
    
    public function testSend()
    {
        $request = $this->_factory->createClientAdditionalService();
        $request->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(200, [
                'Content-Type' => 'application/json',
            ], json_encode([
                "error" => 0,
                "service" => [
                    "id" => 45584,
                    "service_id" => 31,
                    "name" => "dsfgdsfgdsfg",
                    "cost" => 0
                ]
            ]))
        )));
        
        $response = $request
            ->setClientId(111)
            ->setServiceId(31)
            ->setClientBaseServiceId(127654)
            ->send();
        
        $this->assertNotEmpty($response->get('service'));
        
        $this->assertEquals(45584, $response->get('service.id'));
    }
}