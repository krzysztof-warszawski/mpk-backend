<?php


namespace model\service;


interface IBuildingService {

    public function getAllBuildingsList();
    public function getOfferBuildingsList();
    public function getBuildingById($id);
    public function getBuildingByName($name);
    public function createBuildingAndReturn(array $input);
    public function updateBuilding($id, array $input);
    public function deleteBuilding($id);
}
