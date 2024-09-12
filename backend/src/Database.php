<?php declare(strict_types=1);

namespace App;

use PDO;
use PDOException;   

class Database {
    private $db;

    public function getDb() {
        try {
            if (!$this->db) {
                $this->db = new PDO(
                getenv('DATABASE_URL'), 
                getenv('MARIADB_USER'), 
                getenv('MARIADB_PASSWORD'));
            }

            return $this->db;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}