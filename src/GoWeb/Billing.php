<?php

namespace GoWeb;

class Billing extends \Sokil\Rest\Factory
{
    protected $_requestClassNamespace = '\GoWeb\Billing\Request';
    
    private $_appId;
    
    private $_appKey;
    
    public function setAppId($appId)
    {
        $this->_appId = $appId;
        return $this;
    }
    
    public function setAppKey($appKey)
    {
        $this->_appKey = $appKey;
        return $this;
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\CreateClientBaseService
     */
    public function createClientBaseService()
    {
        return $this->createRequest('CreateClientBaseService');
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\UpdateClientBaseService
     */
    public function updateClientBaseService()
    {
        return $this->createRequest('CreateClientBaseService');
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\DeleteClientBaseService
     */
    public function deleteClientBaseService()
    {
        return $this->createRequest('DeleteClientBaseService');
    }
}