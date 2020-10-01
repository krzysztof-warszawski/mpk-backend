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

    /**
     * @param $name
     * @deprecated
     */
    public function getBuildingByName($name) {
        // TODO: Implement getBuildingByName() method.
    }

    public function createBuildingAndReturn(array $input) {
        $this->building->setAddress($input['address']);
        $this->building->setName($input['name']);
        $this->building->setOwner($input['owner']);

        return $this->building->createNewBuildingAndReturn();
    }

    public function updateBuilding($id, array $input) {
        $this->building->setBuildingId($id);
        $this->building->setAddress($input['address']);
        $this->building->setName($input['name']);
        $this->building->setOwner($input['owner']);

        return $this->building->update();
    }

    public function deleteBuilding($id) {
        $this->building->setBuildingId($id);
        return $this->building->delete();
    }
}
