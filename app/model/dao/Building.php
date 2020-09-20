<?php


namespace model\dao;

use config\Database;

class Building {
    private Database $db;

    private int $buildingId;
    private string $address;
    private string $name;
    private string $owner;

    /**
     * Building constructor.
     */
    public function __construct() {
        $this->db = new Database();
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
     * @return string
     */
    public function getAddress(): string {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getOwner(): string {
        return $this->owner;
    }

    /**
     * @param string $owner
     */
    public function setOwner(string $owner): void {
        $this->owner = $owner;
    }


    public function getAllBuildings() {
        $this->db->query('SELECT * FROM building
                                 ORDER BY name');

        $this->db->resultSet();
    }

    public function getOnlyOfferBuildings() {
        $this->db->query('SELECT project.building_id, building.address, 
                                        building.name, building.owner
                                 FROM project
                                 JOIN building
                                 ON project.building_id = building.building_id
                                 GROUP BY project.building_id
                                 HAVING COUNT(project.project_num) < 2
                                 ORDER BY building.name');

        $this->db->resultSet();
    }

    public function getBuildingById() {
        $this->db->query('SELECT * FROM building
                                 WHERE building_id= :id');

        $this->db->bind(':id', $this->buildingId);

        return $this->db->single();
    }

    public function getBuildingByName() {
        $this->db->query('SELECT * FROM building
                                 WHERE name= :name');

        $this->db->bind(':name', $this->name);

        return $this->db->single();
    }

    public function createNewBuildingAndReturn() {
        $this->db->query('CALL CreateBuilding(:address, :name, :owner)');

        $this->db->bind(':address', $this->address);
        $this->db->bind(':name', $this->name);
        $this->db->bind(':owner', $this->owner);

        return $this->db->single();
    }

    public function update() {
        $this->db->query('UPDATE building
                                 SET 
                                    address = :address,
                                    name = :name,
                                    owner = :owner
                                 WHERE building_id= :id');

        $this->db->bind(':address', $this->address);
        $this->db->bind(':name', $this->name);
        $this->db->bind(':owner', $this->owner);
        $this->db->bind(':id', $this->buildingId);

        return $this->db->execute();
    }

    public function delete() {
        $this->db->query('DELETE FROM building 
                                 WHERE building_id = :id');

        $this->db->bind(':id', $this->buildingId);

        return $this->db->execute();
    }
}
