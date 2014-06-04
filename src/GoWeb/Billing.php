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
     * @param string $identity
     * @param int|null $clientBaseServiceId
     * @return \GoWeb\Api\Model\Client
     */
    public function identifyUser($identity, $clientBaseServiceId = null)
    {
        $request = $this
            ->createSignedRequest('IdentifyUser')
            ->setIdentity($identity);
        
        if($clientBaseServiceId) {
            $request->setClientBaseService($clientBaseServiceId);
        }
        
        return $request->send()->getStructure();
    }
    
    /**
     * 
     * @param type $identity
     * @param type $password
     * @param type $clientBaseServiceId
     * @param type $session
     * @return \GoWeb\Api\Model\Client
     */
    public function authentifyUser($identity, $password, $clientBaseServiceId = null, $session = false)
    {
        // this request send password, so request signing not required
        $request = $this
            ->createRequest('AuthentifyUser')
            ->setIdentity($identity)
            ->setPassword($password);
        
        if($clientBaseServiceId) {
            $request->setClientBaseService($clientBaseServiceId);
        }
        
        if($session) {
            $request->startSession();
        }
        
        return $request->send()->getStructure();
    }
    
    /**
     * 
     * @return \GoWeb\Api\Model\Client
     */
    public function getDemoUser()
    {
        return $this
            ->createSignedRequest('AuthentifyUser')
            ->send()
            ->getStructure();
    }
    
    public function updateUser($identity, array $data)
    {
        return $this
            ->createSignedRequest('UpdateUser')
            ->setId($identity)
            ->addQueryParams($data)
            ->send()
            ->getStructure();
    }
    
    /**
     * 
     * @return \GoWeb\Billing\Request\RemindUserPassword
     */
    public function remindUserPassword($email)
    {
        try {
            return 0 === $this
                ->createSignedRequest('RemindUserPassword')
                ->setEmail($email)
                ->send()
                ->getStructure()
                ->get('error');
            
        } catch (\Exception $e) {
            return false;
        }
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