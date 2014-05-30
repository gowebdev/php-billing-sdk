<?php

namespace GoWeb\Billing\Request;

class DeleteClientAdditionalService extends \Sokil\Rest\Client\Request
{
    protected $_action = self::ACTION_DELETE;
    
    protected $_url = '/api/clientAdditionalService';
    
    /**
     *
     * @var \GoWeb\Api\Model\Client\ClientBaseService
     */
    private $_service;
    
    public function init()
    {
        $this->_service = new \GoWeb\Api\Model\Client\ClientAdditionalService;
        
        $this->onBeforeSend(function() {
            $this->setQueryParams($this->_service->toArray());
        });
    }
    
    public function setId($id)
    {
        $this->_service->setId($id);
        return $this;
    }
}