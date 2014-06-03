<?php

namespace GoWeb\Billing\Request;

class UpdateUser extends \Sokil\Rest\Client\Request
{
    protected $_action = self::ACTION_UPDATE;
    
    protected $_url = '/api/user';
    
    /**
     * 
     * @param int|string $identity identity of user
     * @return \GoWeb\Billing\Request\UpdateUser
     */
    public function setId($id)
    {
        $this->setQueryParam('identity', $id);
        return $this;
    }
    
    public function setQueryParams(array $params)
    {
        return parent::setQueryParams(array_intersect_key($params, array_flip(array(
            'email',
            'password',
            'last_name','first_name',
            'gender',
            'birthday'
        ))));
    }
    
    public function send()
    {
        try {
            return parent::send();
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {
            switch($e->getResponse()->getStatusCode())
            {
                case 404: // Not found
                    throw new \GoWeb\Billing\Request\UpdateUser\Exception\UnknownUser('User not found');
            }                
        }
    }
}