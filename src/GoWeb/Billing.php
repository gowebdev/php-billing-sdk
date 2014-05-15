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
}