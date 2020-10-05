<?php


namespace model\service;


interface IMpkService {

    public function createMpk(int $buildingId);
    public function updateMpk(string $mpk, string $serviceType);
    public function addNewMpk(string $buildingId, string $projectNum, string $serviceType);
}
