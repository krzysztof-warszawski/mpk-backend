<?php


namespace model\service;


interface IBuildingService {

    public function getAllBuildingsList();

    public function getOfferBuildingsList();

    public function getBuildingById(int $id);

    public function createBuildingAndInitProject(array $input);

    public function updateBuilding(int $id, array $input);

    public function deleteBuilding(int $id);
}
