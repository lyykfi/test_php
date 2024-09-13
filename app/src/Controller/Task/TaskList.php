<?php declare(strict_types=1);

namespace App\Controller\Task;

require __DIR__ . '/../../../vendor/autoload.php';

use App\Services\TaskService;

class TaskList
{
    private $taskService;

    public function __construct()
    {
        $this->taskService = new TaskService();
    }
    public function __invoke(): void
    {
        $tasks = $this->taskService->getAllTasks();

        header('Content-Type: application/json;charset=utf-8');  
        echo json_encode($tasks, JSON_UNESCAPED_UNICODE);
    }
}

$controller = new TaskList();

echo $controller();