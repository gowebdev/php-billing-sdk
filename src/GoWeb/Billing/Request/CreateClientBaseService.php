<?php

namespace GoWeb\Billing\Request;

class CreateClientBaseService extends \Sokil\Rest\Client\Request\CreateRequest
{    
    protected $_url = '/api/clientBaseService';
    
    /**
     *
     * @var \GoWeb\Api\Model\Client\ClientBaseService
     */
    private $_service;
    
    public function init()
    {
        $this->_service = new \GoWeb\Api\Model\Client\ClientBaseService;
        
        $this->onBeforeSend(function() {
            $this->setQueryParams($this->_service->toArray());
        });
    }
    
    public function setFromServiceObject(\GoWeb\Api\Model\Client\ClientBaseService $service)
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
        $this->_service->setBaseServiceId($serviceId);
        return $this;
    }
    
    public function setCustomName($customName)
    {
        $this->_service->setCustomName($customName);
        return $this;
    }
}