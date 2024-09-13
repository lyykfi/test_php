<?php declare(strict_types=1);

namespace App\Controller\Task;

require __DIR__ . '/../../../vendor/autoload.php';

use App;

class TaskList
{
    private $db;

    public function __construct()
    {
        $this->db = App\Database::getInstance();
    }
    public function __invoke()
    {
        $pdo = $this->db->getPDO();

        $stmt = $pdo->query("SELECT * FROM task");

        header('Content-Type: application/json;charset=utf-8');  
        echo json_encode($stmt->fetchAll(\PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
    }
}

$controller = new TaskList();

echo $controller();