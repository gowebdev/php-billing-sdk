<?php

namespace GoWeb\Billing\Response;

class Services extends \Sokil\Rest\Transport\Structure
{
    public function getService()
    {
        $data = $this->get('service');
        switch($data['type']) {
            case 'BASE':
                return new \GoWeb\Api\Model\Client\ClientBaseService($data);
            case 'ADDITIONAL':
                return new \GoWeb\Api\Model\Client\ClientAdditionalService($data);
        }
    }
    
    public function getServices()
    {
        return $this->getObjectList('services', function($data) {
            switch($data['type']) {
                case 'BASE':
                    return '\GoWeb\Api\Model\Client\ClientBaseService';
                case 'ADDITIONAL':
                    return '\GoWeb\Api\Model\Client\ClientAdditionalService';
            }
        });
    }
    
    public function getServicesArray()
    {
        return $this->get('services');
    }
}