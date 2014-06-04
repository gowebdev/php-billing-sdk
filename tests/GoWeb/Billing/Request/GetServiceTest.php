<?php

namespace GoWeb\Billing\Request;

class GetServicesTest extends \PHPUnit_Framework_TestCase
{
    protected $_factory;
    
    public function setUp()
    {
        $this->_factory = new \GoWeb\Billing('http =>//my/');
    }
    
    public function testGetServices()
    {
        $this->_factory->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(200, [
                'Content-Type' => 'application/json',
            ], json_encode([
                "error" => 0,
                "services"=> array(
                    "6"=> array(
                        "id"=> 6,
                        "name"=> "Рекламний",
                        "description"=> "",
                        "type"=> "BASE",
                        "cost"=> "0",
                        "chargeoff_period"=> "DAILY",
                        "published"=> true,
                        "status"=> "ACTIVE",
                        "regions"=> null,
                        "monthCost"=> 0
                    ),
                    "9"=> array(
                        "id"=> 9,
                        "name"=> "Домашний",
                        "description"=> "",
                        "type"=> "BASE",
                        "cost"=> "0.033",
                        "chargeoff_period"=> "DAILY",
                        "published"=> true,
                        "status"=> "ACTIVE",
                        "regions"=> null,
                        "monthCost"=> 0.99
                    ),
                ),
            ]))
        )));
        
        $response = $this->_factory->getServices();
        
        $this->assertInstanceOf('\Sokil\Rest\Transport\StructureList', $response->getServices());
        
        $this->assertInstanceOf('\GoWeb\Api\Model\Client\ClientBaseService', $response->getServices()->current());
        
        $this->assertEquals('Рекламний', $response->getServices()->current()->getName());
    }
    
    public function testGetService()
    {
        $this->_factory->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(200, [
                'Content-Type' => 'application/json',
            ], json_encode([
                "error" => 0,
                "service"=> array(
                    "id"=> 6,
                    "name"=> "Рекламний",
                    "description"=> "",
                    "type"=> "BASE",
                    "cost"=> "0",
                    "chargeoff_period"=> "DAILY",
                    "published"=> true,
                    "status"=> "ACTIVE",
                    "regions"=> null,
                    "monthCost"=> 0
                ),
            ]))
        )));
        
        $response = $this->_factory->getServices(6);
        
        $this->assertInstanceOf('\GoWeb\Api\Model\Client\ClientBaseService', $response->getService());
        
        $this->assertEquals('Рекламний', $response->getService()->getName());
    }
}