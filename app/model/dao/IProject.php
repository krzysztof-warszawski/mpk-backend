<?php


namespace model\dao;


interface IProject {

    public function getAllProjects();

    public function getProjectById();

    public function getProjectsByBuildingId();

    public function create();

    public function update();

    public function delete();
}
