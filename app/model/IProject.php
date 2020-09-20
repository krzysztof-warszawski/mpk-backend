<?php


namespace model;


interface IProject {

    public function getAllProjects();

    public function getProjectById();

    public function getProjectByBuildingId();

    public function create();

    public function update();

    public function delete();
}
