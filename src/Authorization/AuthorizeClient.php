<?php

declare(strict_types=1);

namespace Capito\Authorization;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Http\ServerRequest;

class AuthorizeClient implements MiddlewareInterface
{
    /**
     * @param ServerRequest $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /**
         * @ignore-vaidation /v2/account
         * @ignore-validation /v2/account/verify
         */
        // @todo add Bearer Auth here and return 401 or 403, if needed
        return $handler->handle($request);
        /*
         * 401: {
  "property": "header::Authorization",
  "message": "Authorization-Header either missing or empty"
}
         */
    }
}
