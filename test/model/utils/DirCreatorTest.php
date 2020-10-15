<?php

namespace model\utils;

use model\service\impl\ProjectService;
use PHPUnit\Framework\TestCase;

class DirCreatorTest extends TestCase {

    private static ProjectService $projectService;
    private static DirCreator $dirCreator;

    /**
     * @beforeClass
     */
    public static function setUpProperties()
    {
        self::$projectService = new ProjectService();
        self::$dirCreator = new DirCreator();
    }


    public function testCreateOfferDir() {
        $project = self::$projectService->getProjectById(1);
        self::$dirCreator->setBuildingName('University of Tests');
        self::$dirCreator->setProject($project);

        self::assertTrue(self::$dirCreator->createOfferDir());
    }

    public function testCreateDir() {
        $project = self::$projectService->getProjectById(1);
        self::$dirCreator->setBuildingName('University of Tests');
        self::$dirCreator->setProject($project);

        self::assertTrue(self::$dirCreator->createDir());
    }
}
