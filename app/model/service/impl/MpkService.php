<?php


namespace model\service\impl;


use model\service\IMpkService;

class MpkService implements IMpkService {

    public function createMpk(int $buildingId) {
        $mpk = strval($buildingId);
        if (strlen($mpk) < 3) {
            $mpk = '0'. $mpk;
        }
        $mpk .= '0000';
        return $mpk;
    }

    public function updateMpk(string $mpk) {
        // TODO: Implement updateMpk() method.
    }

    public function addNewMpk(int $buildingId, string $mpk, int $serviceType) {
        // TODO: Implement addNewMpk() method.
    }


}
