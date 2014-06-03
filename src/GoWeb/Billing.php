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
     * @return \GoWeb\Billing\Request\Register
     */
    public function register(array $data = null)
    {
        $request = $this->createSignedRequest('Register');
        if($data) {
            $data = array_intersect_key($data, array_flip(array(
                'email',
                'password',
                'last_name',
                'first_name',
                'gender', 
                'birth_day',
                'birth_month',
                'birth_year',
                'service'
            )));
            
            if($data) {
                $request->setQueryParams($data);
            }
        }
        
        return $request;
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