<?php


namespace model\service;


interface IProjectService {

    public function getAllProjectsList();

    public function getProjectById($id);

    public function getProjectsByBuildingId($id);

    public function createProject(array $input);

    public function updateProject($id, array $input);

    public function deleteProject($id);

    public function initProject(int $buildingId);
}
