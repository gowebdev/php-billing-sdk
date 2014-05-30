<?php

namespace GoWeb\Billing\Request;

class CreateClientAdditionalService extends \Sokil\Rest\Client\Request
{
    protected $_action = self::ACTION_CREATE;
    
    protected $_url = '/api/clientAdditionalService';
    
    /**
     *
     * @var \GoWeb\Api\Model\Client\ClientAdditionalService
     */
    private $_service;
    
    public function init()
    {
        $this->_service = new \GoWeb\Api\Model\Client\ClientAdditionalService;
        
        $this->onBeforeSend(function() {
            $this->setQueryParams($this->_service->toArray());
        });
    }
    
    public function setFromServiceObject(\GoWeb\Api\Model\Client\ClientAdditionalService $service)
    {
        $this->_service = $service;
        return $this;
    }
    
    public function setClientId($clientId)
    {
        $this->_service->setClientId($clientId);
        return $this;
    }
    
    public function setServiceId($serviceId)
    {
        $this->_service->setAdditionalServiceId($serviceId);
        return $this;
    }
    
    public function setClientBaseServiceId($id)
    {
        $this->_service->setClientBaseServiceId($id);
        return $this;
    }
}