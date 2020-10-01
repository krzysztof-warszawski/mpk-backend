<?php


namespace model\service\impl;


use model\dao\Building;
use model\service\IBuildingService;

class BuildingService implements IBuildingService {

    private Building $building;


    public function __construct() {
        $this->building = new Building();
    }


    public function getAllBuildingsList() {
        return $this->building->getAllBuildings();
    }

    public function getOfferBuildingsList() {
        return $this->building->getOnlyOfferBuildings();
    }

    public function getBuildingById($id) {
        $this->building->setBuildingId($id);
        return $this->building->getBuildingById();
    }

    public function getBuildingByName($name) {
        // TODO: Implement getBuildingByName() method.
    }

    public function createBuildingAndReturn(array $input) {
        // TODO: Implement createBuildingAndReturn() method.
    }

    public function updateBuilding($id, array $input) {
        // TODO: Implement updateBuilding() method.
    }

    public function deleteBuilding($id) {
        // TODO: Implement deleteBuilding() method.
    }
}
