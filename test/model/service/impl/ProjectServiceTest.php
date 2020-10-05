<?php

namespace model\service\impl;

use PHPUnit\Framework\TestCase;


class ProjectServiceTest extends TestCase {

    private static ProjectService $projectService;

    /**
     * @beforeClass
     */
    public static function setUpSomeProjectService()
    {
        self::$projectService = new ProjectService();
    }

    public function testUpdateProject() {

    }

    public function testGetProjectById() {
        $project = self::$projectService->getProjectById(186);

        self::assertEquals('0560016', $project->mpk);
    }

    public function testGetAllProjectsList() {

        $projectsList = self::$projectService->getAllProjectsList();

        self::assertCount(193, $projectsList);
    }

    public function testCreateProject() {

    }

    public function testGetProjectsByBuildingId() {

    }

    public function testDeleteProject() {

    }

    public function testInitProject() {
        self::$projectService->initialProject(78);

        self::assertNotNull(self::$projectService->getProjectsByBuildingId(78));
    }

    public function testAddProject() {

        $input = array(
            "date" => date("Ym"),
            "shortDescription" => "test descr",
            "buildingId" => 60,
            "serviceTypeId" => 5
        );

        $proNum = self::$projectService->addProject($input);

        self::assertNotNull($proNum);
    }

    public function testModifyProject() {

        $input = array(
            "date" => date("Ym"),
            "shortDescription" => "descr",
            "projectNum" => 0,
            "buildingId" => 61,
            "serviceTypeId" => 4
        );

        $proNum = self::$projectService->modifyProject(203, $input);

        self::assertNotNull($proNum);
    }

}
