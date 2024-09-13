<?php declare(strict_types=1);

namespace App;

use PDO;
use PDOException;   

class Database {
    private $db;

    public function getDb() {
        try {
            if (!$this->db) {
                $db = getenv('DATABASE_URL');
                $user = getenv('MARIADB_USER');
                $password = getenv('MARIADB_PASSWORD');

                $this->db = new PDO($db, $user, $password);
            }

            return $this->db;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}