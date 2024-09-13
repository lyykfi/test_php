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
        $db = $this->db->getPDO();

        echo "Hello, world!";
    }
}

$controller = new TaskItem();

echo $controller();