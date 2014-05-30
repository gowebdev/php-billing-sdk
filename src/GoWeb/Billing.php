<?php

namespace GoWeb;

class Billing extends \Sokil\Rest\Client\Factory
{
    protected $_requestClassNamespace = '\GoWeb\Billing\Request';
    
    public function setAppId($appId)
    {
        $this->addSignAdditionalParam('app_id', $appId);
        
        return $this;
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\CreateClientBaseService
     */
    public function createClientBaseService()
    {
        return $this->createSignedRequest('CreateClientBaseService');
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\UpdateClientBaseService
     */
    public function updateClientBaseService()
    {
        return $this->createSignedRequest('UpdateClientBaseService');
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\DeleteClientBaseService
     */
    public function deleteClientBaseService()
    {
        return $this->createSignedRequest('DeleteClientBaseService');
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\CreateClientAdditionalService
     */
    public function createClientAdditionalService()
    {
        return $this->createSignedRequest('CreateClientAdditionalService');
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\DeleteClientAdditionalService
     */
    public function deleteClientAdditionalService()
    {
        return $this->createSignedRequest('DeleteClientAdditionalService');
    }
}