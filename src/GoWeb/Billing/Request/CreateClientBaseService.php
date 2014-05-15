<?php

namespace GoWeb;

class CreateClientBaseService extends \Sokil\Rest\Request
{
    protected $_action = self::ACTION_CREATE;
    
    protected $_url = '/api/clientBaseService';
    
    public function setClientId($clientId)
    {
        $this->setQueryParam('client_id', $clientId);
        return $this;
    }
    
    public function setServiceId($serviceId)
    {
        $this->setQueryParam('service_id', $serviceId);
        return $this;
    }
    
    public function setCustomName($customName)
    {
        $this->setQueryParam('custom_name', $customName);
        return $this;
    }
}