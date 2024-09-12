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
        $db = $this->db->getDb();
        var_dump($db);
        
        echo "Hello, world!";
    }
}