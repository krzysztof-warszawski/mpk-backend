<?php


namespace model\service;


interface IProjectService {

    public function getAllProjectsList();

    public function getProjectById($id);

    public function getProjectsByBuildingId($id);

    public function createProject();

    public function updateProject($id);

    public function deleteProject($id);
}
