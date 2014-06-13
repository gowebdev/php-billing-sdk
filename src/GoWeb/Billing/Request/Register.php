<?php

namespace GoWeb\Billing\Request;

class Register extends \Sokil\Rest\Client\Request\CreateRequest
{    
    protected $_url = '/api/user';
}