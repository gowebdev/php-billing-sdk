<?php

namespace GoWeb\Billing\Request;

class Register extends \Sokil\Rest\Client\Request
{
    protected $_action = self::ACTION_CREATE;
    
    protected $_url = '/api/user';
}