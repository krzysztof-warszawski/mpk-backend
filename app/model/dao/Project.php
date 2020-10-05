<?php


namespace model\dao;

use config\Database;

class Project implements IProject {
    private Database $db;

    private int $id;
    private ?string $date;
    private ?string $floor;
    private string $mpk;
    private int $projectNum;
    private ?string $shortDescription;
    private ?string $tenant;
    private int $buildingId;
    private int $serviceTypeId;

    /**
     * Project constructor.
     */
    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(?string $date): void {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getFloor(): string {
        return $this->floor;
    }

    /**
     * @param string $floor
     */
    public function setFloor(?string $floor): void {
        $this->floor = $floor;
    }

    /**
     * @return string
     */
    public function getMpk(): string {
        return $this->mpk;
    }

    /**
     * @param string $mpk
     */
    public function setMpk(string $mpk): void {
        $this->mpk = $mpk;
    }

    /**
     * @return int
     */
    public function getProjectNum(): int {
        return $this->projectNum;
    }

    /**
     * @param int $projectNum
     */
    public function setProjectNum(int $projectNum): void {
        $this->projectNum = $projectNum;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription(?string $shortDescription): void {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getTenant(): string {
        return $this->tenant;
    }

    /**
     * @param string $tenant
     */
    public function setTenant(?string $tenant): void {
        $this->tenant = $tenant;
    }

    /**
     * @return int
     */
    public function getBuildingId(): int {
        return $this->buildingId;
    }

    /**
     * @param int $buildingId
     */
    public function setBuildingId(int $buildingId): void {
        $this->buildingId = $buildingId;
    }

    /**
     * @return int
     */
    public function getServiceTypeId(): int {
        return $this->serviceTypeId;
    }

    /**
     * @param int $serviceTypeId
     */
    public function setServiceTypeId(int $serviceTypeId): void {
        $this->serviceTypeId = $serviceTypeId;
    }


    public function getAllProjects() {
        $this->db->query('SELECT project.id, building.name as building_name, project.date, project.floor,
                                    project.mpk, project.project_num, project.short_description, 
                                    project.tenant, service_type.name as service
                                 FROM project
                                    JOIN building
                                    ON project.building_id = building.building_id
                                    JOIN service_type
                                    ON project.service_type_id = service_type.id
                                 ORDER BY building_name');

        return $this->db->resultSet();
    }

    public function getProjectById() {
        $this->db->query('SELECT * FROM project
                                    WHERE id = :id');

        $this->db->bind(':id', $this->id);
        return $this->db->single();
    }

    public function getProjectsByBuildingId() {
        $this->db->query('SELECT project.id, project.date, project.floor, project.mpk, 
                                    project.project_num, project.short_description, 
                                    project.tenant, service_type.name as service
                                 FROM project
                                    JOIN service_type
                                    ON project.service_type_id = service_type.id
                                 WHERE building_id = :id
                                    ORDER BY project.id');

        $this->db->bind(':id', $this->buildingId);
        return $this->db->resultSet();
    }

    public function getTopProjectForBuildingId(string $buildingId) {
        $this->db->query('SELECT project_num
                                    FROM project
                                 WHERE building_id = :id
                                    ORDER BY project.id DESC
                                 LIMIT 1;');

        $this->db->bind(':id', $buildingId);
        return $this->db->single();
    }

    public function create() {
        $this->db->query('INSERT INTO project (date, floor, mpk, project_num,
                                    short_description, tenant, building_id, service_type_id)
                                 VALUES (:date, :floor, :mpk, :project_num, :short_description, 
                                    :tenant, :building_id, :service_type_id)');

        $this->db->bind(':date', $this->date);
        $this->db->bind(':floor', $this->floor);
        $this->db->bind(':mpk', $this->mpk);
        $this->db->bind(':project_num', $this->projectNum);
        $this->db->bind(':short_description', $this->shortDescription);
        $this->db->bind(':tenant', $this->tenant);
        $this->db->bind(':building_id', $this->buildingId);
        $this->db->bind(':service_type_id', $this->serviceTypeId);

        return $this->db->rowCount();
    }

    public function update() {
        $this->db->query('UPDATE project
                                 SET 
                                    date = :date,
                                    floor = :floor,
                                    mpk = :mpk,
                                    project_num = :project_num,
                                    short_description = :short_description,
                                    tenant = :tenant,
                                    building_id = :building_id,
                                    service_type_id = :service_type_id
                                 WHERE id = :id');

        $this->db->bind(':date', $this->date);
        $this->db->bind(':floor', $this->floor);
        $this->db->bind(':mpk', $this->mpk);
        $this->db->bind(':project_num', $this->projectNum);
        $this->db->bind(':short_description', $this->shortDescription);
        $this->db->bind(':tenant', $this->tenant);
        $this->db->bind(':building_id', $this->buildingId);
        $this->db->bind(':service_type_id', $this->serviceTypeId);
        $this->db->bind(':id', $this->id);

        return $this->db->rowCount();
    }

    public function delete() {
        $this->db->query('DELETE FROM project 
                                    WHERE id = :id');

        $this->db->bind(':id', $this->id);

        return $this->db->rowCount();
    }
}
