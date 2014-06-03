<?php

namespace GoWeb\Billing\Request;

class IdentifyUser extends \Sokil\Rest\Client\Request
{
    protected $_action = self::ACTION_READ;
    
    protected $_url = '/api/user';
    
    protected $_structureClassName = '\GoWeb\Api\Model\Client';
    
    private $_clientBaseService;
    
    public function setIdentity($identity)
    {
        $this->setQueryParam('identity', $identity);
        return $this;
    }
    
    public function setClientBaseService($serviceId)
    {
        $this->_clientBaseService = (int) $serviceId;
        return $this;
    }
    
    public function send()
    {
        try {
            $client = parent::send();
            if($client->get('error')) {
                throw new \Exception($client->get('errorMessage'));
            }

            if($this->_clientBaseService) {
                $client->setActiveClientBaseServiceId($this->_clientBaseService);
            }
            
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {
            switch($e->getResponse()->getStatusCode()) {
                case 401: // Unauthorised
                    throw new \GoWeb\Billing\Request\AuthentifyUser\Exception\Wrongcredentials('Password wrong');
                case 403: // Forbidden
                    throw new \GoWeb\Billing\Request\AuthentifyUser\Exception\Accountblocked('Account blocked');
                case 404: // Not found
                    throw new \GoWeb\Billing\Request\AuthentifyUser\Exception\Wrongcredentials('Email wrong');
                default: // Other code
                    throw new \GoWeb\Billing\Request\AuthentifyUser\Exception\Generic('Remote server error with code ' . $response->getStatusCode());
            }  
        }
        
        return $client;
    }
}