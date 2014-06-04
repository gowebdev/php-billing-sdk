<?php

namespace GoWeb\Billing\Request;

class UpdateUserTest extends \PHPUnit_Framework_TestCase
{
    protected $_factory;
    
    public function setUp()
    {
        $this->_factory = new \GoWeb\Billing('http =>//my/');
    }
    
    public function testHelper()
    {
        $this->_factory->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(200, [
                'Content-Type' => 'application/json',
            ], json_encode([
                "error" => 0,
            ]))
        )));
        
        $client = $this->_factory->updateUser(42, array('last_name' => 'Marfa'));
        
        $this->assertEquals(0, $client->get('error'));
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
        
        $request = $this->_factory
            ->createSignedRequest('UpdateUser')
            ->setId(42)
            ->addQueryParams(array('last_name' => 'Marfa'));
        
        $this->assertEquals('my/api/user?last_name=Marfa&identity=42', $request->getUrl());
        
        $client = $request->send()->getStructure();
        
        $this->assertEquals(0, $client->get('error'));
    }
    
    /**
     * @expectedException \GoWeb\Billing\Request\UpdateUser\Exception\UnknownUser
     */
    public function testSendWrongCredentials()
    {
        $this->_factory->addSubscriber(new \Guzzle\Plugin\Mock\MockPlugin(array(
            new \Guzzle\Http\Message\Response(404, [
                'Content-Type' => 'application/json',
            ])
        )));
        
        $this->_factory->updateUser('identity@server.com', array('last_name' => 'Marfa'));
    }
}