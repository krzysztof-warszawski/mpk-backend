<?php


namespace model\service;


interface IProjectService {

    public function getAllProjectsList();

    public function getProjectById(int $id);

    public function getProjectsByBuildingId(int $id);

    public function createProject(array $input);

    public function updateProject(int $id, array $input);

    public function deleteProject(int $id);

    public function deleteProjectByBuildingId(int $id);

    public function initialProject(int $buildingId);

    public function addProject(array $input);

    public function modifyProject(int $id, array $input);

    public function addGuaranteeProject(array $input);
}
