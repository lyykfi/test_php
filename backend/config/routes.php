<?php declare(strict_types=1);

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

return simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/api/v1/task', App\Controller\Task\TaskList::class);
});