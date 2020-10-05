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

    public function updateMpk(string $mpk, string $serviceType) {
        return substr_replace($mpk, $serviceType, -1);
    }

    public function addNewMpk(string $buildingId, string $projectNum, string $serviceType) {
        if (strlen($buildingId) < 3) {
            $buildingId = '0'. $buildingId;
        }
        if (strlen($projectNum) == 1) {
            $projectNum = '00'. $projectNum;
        } else if (strlen($projectNum) == 2) {
            $projectNum = '0'. $projectNum;
        }
        $mpk = $buildingId . $projectNum . $serviceType;

        return $mpk;
    }

}
