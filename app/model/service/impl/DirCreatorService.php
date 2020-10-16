<?php


namespace model\service\impl;


use model\utils\DirCreator;

class DirCreatorService {

    private ProjectService $projectService;
    private BuildingService $buildingService;
    private DirCreator $dirCreator;
    private object $project;

    /**
     * DirCreatorService constructor.
     */
    public function __construct() {
        $this->projectService = new ProjectService();
        $this->buildingService = new BuildingService();
        $this->dirCreator = new DirCreator();
    }


    public function createDirectories(int $id) {
        $this->setupParams($id);

        if ($this->project->service_type_id == 0) {
            return $this->dirCreator->createOfferDir();

        } elseif ($this->project->service_type_id == 5) {
            if ($this->dirCreator->createDir()) {
                $this->setUpForGuaranteeDir();
                return $this->dirCreator->createDir();
            }
            return false;
        } else {
            return $this->dirCreator->createDir();
        }

    }

    private function setUpForGuaranteeDir() {
        $this->project->mpk = substr_replace($this->project->mpk, 6,-1);
        $this->dirCreator->setProject($this->project);
    }

    private function setupParams(int $id) {
        $this->project = $this->projectService->getProjectById($id);
        $buildingName = $this->getBuildingName($this->project->building_id);
        $this->dirCreator->setBuildingName($buildingName);
        $this->dirCreator->setProject($this->project);
    }

    private function getBuildingName(int $id) {
        $building = $this->buildingService->getBuildingById($id);
        return $building->name;
    }
}