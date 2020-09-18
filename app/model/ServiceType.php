<?php


namespace model;

require '../config/Database.php';
use config\Database;

class ServiceType {
    private Database $db;

    private int $id;
    private string $name;


    /**
     * ServiceType constructor.
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
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }


    public function getAllServiceTypes() {
        $this->db->query('SELECT * FROM service_type 
                                ORDER BY id');

        return $this->db->resultSet();
    }

    public function getServiceTypeById() {
        $this->db->query('SELECT * FROM service_type 
                                 WHERE id= :id');

        $this->db->bind(':id', $this->id);

        return $this->db->resultSet();
    }
}
