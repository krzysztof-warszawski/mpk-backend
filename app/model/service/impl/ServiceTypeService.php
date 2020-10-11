<?php


namespace model\service\impl;


use model\dao\ServiceType;

class ServiceTypeService {

    private ServiceType $serviceType;

    /**
     * ServiceTypeService constructor.
     */
    public function __construct()
    {
        $this->serviceType = new ServiceType();
    }

    public function getAllServiceTypes()
    {
        return $this->serviceType->getAll();
    }


}