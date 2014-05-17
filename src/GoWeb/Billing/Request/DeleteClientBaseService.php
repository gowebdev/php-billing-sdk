<?php

namespace GoWeb;

class DeleteClientBaseService extends \Sokil\Rest\Client\Request
{
    protected $_action = self::ACTION_DELETE;
    
    protected $_url = '/api/clientBaseService';
    
    /**
     *
     * @var \GoWeb\Api\Model\Client\ClientBaseService
     */
    private $_service;
    
    public function init()
    {
        $this->_service = new \GoWeb\Api\Model\Client\ClientBaseService;
        
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