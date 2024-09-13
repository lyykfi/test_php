<?php declare(strict_types=1);

namespace App;

use PDO;
use PDOException;   

class Database {
    private $pdo;

    public static function getInstance(): Database {
        static $instance = null;

        if (null === $instance) {
            try {
                $instance = new self;

                $db = getenv('DATABASE_URL');
                $user = getenv('MARIADB_USER');
                $password = getenv('MARIADB_PASSWORD');

                $instance->pdo = new PDO($db, $user, $password);

            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        return $instance;
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }

    protected function __construct()
    {
    }

    final private function __clone()
    {
    }

    final private function __wakeup()
    {
    }

}