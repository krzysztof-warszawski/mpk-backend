<?php

namespace config;

//require 'init.php';

use PDO;
use PDOException;
use PDOStatement;

class Database {

    private PDO $dbh;
    private string $error;
    private PDOStatement $stmt;

    public function __construct() {

        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $dbname = $_ENV['DB_NAME'];

        // Set DSN
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create a new PDO instance
        try {
            $this->dbh = new PDO ($dsn, $user, $pass, $options);
        }        // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    // Prepare statement with query
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Bind values
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute() {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single() {
        $this->execute();
        $obj = $this->stmt->fetch(PDO::FETCH_OBJ);
        $this->stmt->closeCursor();
        return $obj;
    }

    // Get record row count
    public function rowCount() {
        $this->stmt->execute();
        $rowCount = $this->stmt->rowCount();
        $this->stmt->closeCursor();
        return $rowCount;
    }

    // Returns the last inserted ID
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    // Prints error if unsuccessful execution
    public function error() {
        return $this->stmt->errorInfo();
    }
}
