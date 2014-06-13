<?php

namespace GoWeb\Billing\Request;

class RemindUserPassword extends \Sokil\Rest\Client\Request\ReadRequest
{    
    protected $_url = '/api/reminduserpass';
    
    public function setEmail($email)
    {
        $this->setQueryParam('email', $email);
        return $this;
    }
}