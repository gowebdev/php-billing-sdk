<?php

namespace GoWeb\Billing\Request;

class GetServices extends \Sokil\Rest\Client\Request\ReadRequest
{    
    protected $_url = '/api/service';
    
    protected $_structureClassName = '\GoWeb\Billing\Response\Services';
    
    public function setServiceId($id)
    {        
        $id = (int) $id;
        if(!$id) {
            throw new \Exception('Wrong service specified');
        }
        
        $this->setQueryParam('id', $id);
        
        return $this;
    }
    
    public function setServiceIdList(array $idList)
    {
        $idList = array_filter(array_map('intval', $idList));
        if(!$idList) {
            throw new \Exception('Wrong service list specified');
        }
        
        $this->setQueryParam('id', impldode(',', $idList));
        
        return $this;
    }
}