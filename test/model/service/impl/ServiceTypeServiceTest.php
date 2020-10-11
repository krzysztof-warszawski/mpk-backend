<?php

namespace model\service\impl;

use PHPUnit\Framework\TestCase;

class ServiceTypeServiceTest extends TestCase {

    private static ServiceTypeService $service;

    /**
     * @beforeClass
     */
    public static function setUpProjectService()
    {
        self::$service = new ServiceTypeService();
    }

    public function testGetAllServiceTypes() {
        $serviceTypes = self::$service->getAllServiceTypes();

        self::assertCount(7, $serviceTypes);
    }
}
