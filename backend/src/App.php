<?php declare(strict_types = 1);

namespace App;

use App\Database;
use DateTime;
use PDO;

class App {
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public static function seedTasks(PDO $pdo) {
        $sql = "INSERT INTO `task` (`title`, `data`, `author`, `status`, `description`) VALUES (:title, :data, :author, :status, :description)";
        $date = new DateTime();

        for($i = 0; $i < 1000; $i++) {
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

            $pdo->prepare($sql)->execute($data);

        }
    }

    public function seeds() {
        $pdo = $this->db->getDb();

        $stmt = $pdo->query("SELECT * FROM task");

        var_dump($stmt->rowCount());

        if($stmt->rowCount() == 0) {
            App::seedTasks($pdo);
        }

    }
}