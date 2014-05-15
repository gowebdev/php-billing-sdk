<?php

namespace GoWeb;

class CreateClientBaseService extends \Sokil\Rest\Request
{
    protected $_action = self::ACTION_UPDATE;
    
    protected $_url = '/api/clientBaseService';
    
    public function setId($id)
    {
        $this->setQueryParam('id', $id);
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
    
    public function setStatus($status)
    {
        $this->setQueryParam('status', $status);
        return $this;
    }
}