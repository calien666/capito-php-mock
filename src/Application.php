<?php

declare(strict_types=1);

namespace Capito;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application
{
    public function run(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('Hello, I am here');
        return $response;
    }

    public function failure(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write('404: Not Found');
        return $response->withStatus(404)->withHeader('Content-type', 'text/plain');
    }
}
