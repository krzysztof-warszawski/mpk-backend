<?php


namespace model\service;


interface IMpkService {

    public function createMpk(int $buildingId);
    public function updateMpk(string $mpk);
    public function addNewMpk(int $buildingId, string $mpk, int $serviceType);
}
