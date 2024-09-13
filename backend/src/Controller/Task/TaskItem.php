<?php declare(strict_types=1);

namespace App\Controller\Task;

require __DIR__ . '/../../../vendor/autoload.php';

use App\Database;

class TaskItem
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    public function __invoke()
    {
        $pdo = $this->db->getPDO();

        $stmt = $pdo->prepare("SELECT * FROM task WHERE id=:id");
        $stmt->execute(['id' => $_GET['task']]);

        header('Content-Type: application/json;charset=utf-8');  
        echo json_encode($stmt->fetch(\PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
    }
}

$controller = new TaskItem();

echo $controller();