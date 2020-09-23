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

    public function createProject() {
        // TODO: Implement createProject() method.
    }

    public function updateProject($id) {
        // TODO: Implement updateProject() method.
    }

    public function deleteProject($id) {
        // TODO: Implement deleteProject() method.
    }
}
