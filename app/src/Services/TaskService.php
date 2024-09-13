<?php declare(strict_types=1);

namespace App\Services;

use App;

class TaskService {
    private $db;

    private $pdo;

    public function __construct() {
        $this->db = App\Database::getInstance();
        $this->pdo = $this->db->getPDO();
    }

    public function getAllTasks() {
        $stmt = $this->pdo->query("SELECT * FROM task");

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTaskById(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE id=:id");
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}