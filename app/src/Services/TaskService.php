<?php declare(strict_types=1);

namespace App\Services;

use App;
use DateTime;

class TaskService {
    private $db;

    private $pdo;

    public function __construct() {
        $this->db = App\Database::getInstance();
        $this->pdo = $this->db->getPDO();
    }

    public function getAllTasks(): array {
        $stmt = $this->pdo->query("SELECT * FROM task");

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTaskById(int $id): mixed {
        $stmt = $this->pdo->prepare("SELECT * FROM task WHERE id=:id");
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function seedTasks(): void {
        $sql = "INSERT INTO `task` (`title`, `data`, `author`, `status`, `description`) VALUES (:title, :data, :author, :status, :description)";
        $date = new DateTime();

        for($i = 1; $i <= 1000; $i++) {
            if ($i != 0) {
                $date->add(new \DateInterval('PT1H'));
            }

            $data = [
                'title' => "Задача $i",
                'data' => date("Y-m-d H:i:s", $date->getTimestamp()),
                'author' => "Автор $i",
                'status' => "Статус $i",
                'description' => "Описание $i",
            ];

            $this->pdo->prepare($sql)->execute($data);

        }
    }
}