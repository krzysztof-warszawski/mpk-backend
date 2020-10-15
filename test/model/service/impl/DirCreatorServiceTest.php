<?php

namespace model\service\impl;

use PHPUnit\Framework\TestCase;

class DirCreatorServiceTest extends TestCase {

    private static DirCreatorService $dirCreatorService;

    /**
     * @beforeClass
     */
    public static function setUpProperties()
    {
        self::$dirCreatorService = new DirCreatorService();
    }


    public function testCreateOfferDirectories() {
        $result = self::$dirCreatorService->createDirectories(5);

        self::assertTrue($result);
    }

    public function testCreateGuaranteeDirectories() {
        $result = self::$dirCreatorService->createDirectories(16);

        self::assertTrue($result);
    }

    public function testCreateDirectories() {
        $result = self::$dirCreatorService->createDirectories(210);

        self::assertTrue($result);
    }
}
