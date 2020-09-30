<?php


namespace model\service\impl;

use model\dao\Project;
use model\service\IProjectService;

class ProjectService implements IProjectService {

    private Project $project;


    public function __construct() {
        $this->project = new Project();
    }


    public function getAllProjectsList() {
        return $this->project->getAllProjects();
    }

    public function getProjectById($id) {
        $this->project->setId($id);
        return $this->project->getProjectById();
    }

    public function getProjectsByBuildingId($id) {
        // TODO: Implement getProjectsByBuildingId() method.
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

    public function updateProject($id, array $input) {
        // TODO: Implement updateProject() method.
    }

    public function deleteProject($id) {
        $this->project->setId($id);
        return $this->project->delete();
    }
}
