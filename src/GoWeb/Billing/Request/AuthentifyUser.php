<?php

namespace GoWeb\Billing\Request;

class AuthentifyUser extends IdentifyUser
{
    public function setPassword($password)
    {
        $this->setQueryParam('password', $password);
        return $this;
    }
    
    public function startSession()
    {
        $this->setQueryParam('session', 1);
        return $this;
    }
}