<?php


namespace model\utils;


class DirCreator {

    private string $corePath;
    private string $buildingName;
    private object $project;

    /**
     * DirCreator constructor.
     */
    public function __construct() {
        $this->corePath = $_ENV['DIR_PATH'];
    }

    /**
     * @param string $buildingName
     */
    public function setBuildingName(string $buildingName): void {
        $this->buildingName = $buildingName;
    }

    /**
     * @param object $project
     */
    public function setProject(object $project): void {
        $this->project = $project;
    }


    public function createDir() {
        $coreDir = $this->corePath.'/'.$this->project->mpk.'_'.$this->project->date.'_'
            .$this->buildingName.'_'.$this->project->floor.'_'.$this->project->tenant;

        $subDir = $this->project->mpk.'_Dokumentacja';

        return mkdir("$coreDir/$subDir",0777, true);
    }

    public function createOfferDir() {
        $coreDir = $this->corePath.'/'.$this->project->date.'_'.$this->project->building_id.'_'
            .$this->buildingName.'_'.$this->project->floor.'_'.$this->project->tenant;

        $subDir = $this->project->date.'_'.$this->project->building_id.'_'
            .$this->project->tenant.'_Dostawcy';

        return mkdir("$coreDir/$subDir",0777, true);
    }
}