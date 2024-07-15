<?php

declare(strict_types=1);

namespace Capito\Middleware;

use Capito\Database\ResetDatabase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;

class ResetMiddleware
{
    public function __invoke(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = $handler->handle($request);
        ResetDatabase::reset();
        return $response;
    }
}
