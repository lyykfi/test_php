<?php declare(strict_types=1);

namespace App\Controller\Task;

require __DIR__ . '/../../../vendor/autoload.php';

use App\Services\TaskService;

class TaskItem
{
    private $taskService;

    public function __construct()
    {
        $this->taskService = new TaskService();
    }
    public function __invoke(): void
    {   
        $task = $this->taskService->getTaskById(intval($_GET['task']));

        header('Content-Type: application/json;charset=utf-8');  
        echo json_encode($task, JSON_UNESCAPED_UNICODE);
    }
}

$controller = new TaskItem();

echo $controller();