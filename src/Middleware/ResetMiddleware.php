<?php

declare(strict_types=1);

namespace Capito\Middleware;

use Capito\Database\ResetDatabase;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Interfaces\ResponseInterface;

class ResetMiddleware
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $response = $next($request, $response);
        ResetDatabase::reset();
        return $response;
    }
}
