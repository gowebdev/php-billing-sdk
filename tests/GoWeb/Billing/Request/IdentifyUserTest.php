<?php

namespace GoWeb\Billing\Request;

class IdentifyUserTest extends \PHPUnit_Framework_TestCase
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
                "balance" => [
                    "amount" => 0,
                    "currency" => "EUR"
                ],
                "profile" => [
                    "id" => 48126,
                    "email" => "identity@server.com",
                    "hash" => "46b3b035f472e4f9125d69d1509471c47d6429db",
                    "contract_number" => "00048126",
                    "status" => "ACTIVE",
                    "last_name" => "aaa",
                    "first_name" => "bbb",
                    "gender" => "MALE",
                    "birthday" => "1991-01-01"
                ],
                "baseServices" => [
                    [
                        "id" => 12345,
                        "service_id" => 9,
                        "name" => "Домашний",
                        "custom_name" => "Service #45559",
                        "cost" => 0.033,
                        "chargeoff_period" => "DAILY",
                        "status" => "ACTIVE",
                        "catchup" => 1,
                        "ad" => 0,
                        "total_cost" => 0.033,
                        "total_monthly_cost" => 0.99
                    ],
                ],
            ]))
        )));
        
        $client = $this->_factory->identifyUser('identity@server.com', 12345);
        
        $this->assertEquals(0, $client->get('error'));
        
        $this->assertInstanceOf('\GoWeb\API\Model\Client', $client);
    }
    
    /**
     * @expectedException \GoWeb\Billing\Request\AuthentifyUser\Exception\Wrongcredentials
     */
    public function testSendWrongCredentials()
    {
        $this->_factory->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(401, [
                'Content-Type' => 'application/json',
            ])
        )));
        
        $this->_factory->identifyUser('identity@server.com', 12345);
    }
    
    /**
     * @expectedException \GoWeb\Billing\Request\AuthentifyUser\Exception\Accountblocked
     */
    public function testSendAccountBlocked()
    {
        $this->_factory->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(403, [
                'Content-Type' => 'application/json',
            ])
        )));
        
        $this->_factory->identifyUser('identity@server.com', 12345);
    }
    
    /**
     * @expectedException \GoWeb\Billing\Request\AuthentifyUser\Exception\Wrongcredentials
     */
    public function testSendUnknownIdentity()
    {
        $this->_factory->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(404, [
                'Content-Type' => 'application/json',
            ])
        )));
        
        $this->_factory->identifyUser('identity@server.com', 12345);
    }
}