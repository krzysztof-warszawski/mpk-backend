<?php


namespace model\service\impl;

use model\dao\Project;
use model\service\IProjectService;

class ProjectService implements IProjectService {

    private Project $project;
    private MpkService $mpkService;


    public function __construct() {
        $this->project = new Project();
        $this->mpkService = new MpkService();
    }


    public function getAllProjectsList() {
        return $this->project->getAllProjects();
    }

    public function getProjectById(int $id) {
        $this->project->setId($id);
        return $this->project->getProjectById();
    }

    public function getProjectsByBuildingId(int $id) {
        $this->project->setBuildingId($id);
        return $this->project->getProjectsByBuildingId();
    }

    public function createProject(array $input) {
        $this->project->setDate($input['date'] ?? null);
        $this->project->setFloor($input['floor'] ?? null);
        $this->project->setMpk($input['mpk']);
        $this->project->setProjectNum((int) $input['projectNum']);
        $this->project->setShortDescription($input['shortDescription'] ?? null);
        $this->project->setTenant($input['tenant'] ?? null);
        $this->project->setBuildingId((int) $input['buildingId']);
        $this->project->setServiceTypeId((int) $input['serviceTypeId']);

        return $this->project->create();
    }

    public function updateProject(int $id, array $input) {
        $this->project->setId($id);
        $this->project->setDate($input['date'] ?? null);
        $this->project->setFloor($input['floor'] ?? null);
        $this->project->setMpk($input['mpk']);
        $this->project->setProjectNum((int) $input['projectNum']);
        $this->project->setShortDescription($input['shortDescription'] ?? null);
        $this->project->setTenant($input['tenant'] ?? null);
        $this->project->setBuildingId((int) $input['buildingId']);
        $this->project->setServiceTypeId((int) $input['serviceTypeId']);

        return $this->project->update();
    }

    public function deleteProject(int $id) {
        $this->project->setId($id);
        return $this->project->delete();
    }

    public function deleteProjectByBuildingId(int $id) {
        return $this->project->deleteByBuildingId($id);
    }

    public function initialProject(int $buildingId) {
        $mpk = $this->mpkService->createMpk($buildingId);
        $input = array(
            "date" => date("Ym"),
            "mpk" => $mpk,
            "projectNum" => 0,
            "shortDescription" => "OFERTOWANIE I MARKETING",
            "buildingId" => $buildingId,
            "serviceTypeId" => 0
        );
        return $this->createProject($input);
    }

    public function addProject(array $input) {
        $topProjectNum = $this->project->getTopProjectForBuildingId($input['buildingId']);
        $projectNum = $topProjectNum->project_num + 1;

        $mpk = $this->mpkService->addNewMpk($input['buildingId'], $projectNum, $input['serviceTypeId']);
        $input['mpk'] = $mpk;
        $input['projectNum'] = $projectNum;

        $result = $this->createProject($input);

        if ($input['serviceTypeId'] == 5) {
            $this->addGuaranteeProject($input);
        }

        return $result;
    }

    public function modifyProject(int $id, array $input) {
        $mpk = $this->mpkService->addNewMpk($input['buildingId'], $input['projectNum'], $input['serviceTypeId']);
        $input['mpk'] = $mpk;

        return $this->updateProject($id, $input);
    }

    public function addGuaranteeProject(array $input) {
        $mpk = $this->mpkService->addNewMpk($input['buildingId'], $input['projectNum'], 6);
        $input['mpk'] = $mpk;
        $input['floor'] = null;
        $input['serviceTypeId'] = 6;
        $input['shortDescription'] = "Gwarancja dla ". $input['date'] . "_". $input['shortDescription'];
        $input['date'] = null;

        $this->createProject($input);
    }
}
