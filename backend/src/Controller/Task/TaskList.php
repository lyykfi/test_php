<?php declare(strict_types=1);


namespace App\Controller\Task;

use App\Database;

class TaskList
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function __invoke()
    {
        $pdo = $this->db->getDb();

        $stmt = $pdo->query("SELECT * FROM task");

        header('Content-Type: application/json;charset=utf-8');  
        echo json_encode($stmt->fetchAll(), JSON_UNESCAPED_UNICODE);
    }
}