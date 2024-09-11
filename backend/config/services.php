<?php declare(strict_types=1);

use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;

return [
    ServerRequestInterface::class => ServerRequestFactory::fromGlobals(),
];