<?php

namespace model\service\impl;

use PHPUnit\Framework\TestCase;

class BuildingServiceTest extends TestCase {


    private static BuildingService $buildingService;

    /**
     * @beforeClass
     */
    public static function setUpBuildingService()
    {
        self::$buildingService = new BuildingService();
    }

    public function testDeleteBuilding() {
        $rowCount = self::$buildingService->deleteBuilding(78);

        self::assertEquals(1, $rowCount);
    }
}
