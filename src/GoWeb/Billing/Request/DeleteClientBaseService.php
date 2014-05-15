<?php

namespace GoWeb;

class DeleteClientBaseService extends \Sokil\Rest\Request
{
    protected $_action = self::ACTION_DELETE;
    
    protected $_url = '/api/clientBaseService';
    
    public function setId($id)
    {
        $this->setQueryParam('id', $id);
        return $this;
    }
}