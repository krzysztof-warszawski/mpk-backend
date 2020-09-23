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
}
