<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

use Relay\Relay;
use Laminas\Diactoros\ServerRequestFactory;
use HttpSoft\Emitter\SapiEmitter;

$routes = require __DIR__ . '/config/routes.php';
$container = require __DIR__ . '/config/container.php';

$middleware = [
    new Middlewares\FastRoute($routes),
    new Middlewares\RequestHandler($container)
];

$requestHandler = new Relay($middleware);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());
$emitter = new SapiEmitter();

return $emitter->emit($response);