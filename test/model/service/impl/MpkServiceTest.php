<?php

namespace model\service\impl;

use PHPUnit\Framework\TestCase;

class MpkServiceTest extends TestCase {

    /**
     * @var MpkService
     */
    private static MpkService $mpkService;

    /**
     * @beforeClass
     */
    public static function setUpSomeProjectService()
    {
        self::$mpkService = new MpkService();
    }


    public function testUpdateMpk() {
        $mpk = self::$mpkService->createMpk(77);

        self::assertEquals('0770000', $mpk);
    }

    public function testCreateMpk() {
        $mpk = self::$mpkService->updateMpk('0770224', '6');

        self::assertEquals('0770226', $mpk);
    }

    public function testAddNewMpk() {
        $mpk = self::$mpkService->addNewMpk(17, '001', '3');

        self::assertEquals('0170013', $mpk);
    }
}
