<?php declare(strict_types=1);

namespace App\Controller\Task;

require __DIR__ . '/../../../vendor/autoload.php';

use App\Services\TaskService;
use DateTime;

class TaskList
{
    private $taskService;

    public function __construct()
    {   
        $this->taskService = new TaskService();
    }

    private function seeds(): void {
        session_start();

        $lastSeeded = $_SESSION["task_seeded"];
        $date = new DateTime();

        if (!$lastSeeded || ($lastSeeded && $date->diff(new DateTime('@'    .$lastSeeded))->h > 1)) {
            $this->taskService->seedTasks();

            $_SESSION["task_seeded"] = $date->getTimestamp(); 
        }
    }

    public function __invoke(): void
    {
        $this->seeds();
        
        $tasks = $this->taskService->getAllTasks();

        header('Content-Type: application/json;charset=utf-8');  
        echo json_encode($tasks, JSON_UNESCAPED_UNICODE);
    }
}



$controller = new TaskList();

echo $controller();