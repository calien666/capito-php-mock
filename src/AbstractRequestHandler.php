<?php

declare(strict_types=1);

namespace Capito;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractRequestHandler
{
    protected const array ALLOWED = [];

    protected const bool OVERRIDE = false;

    protected const array REQUIRED_VALUES = [];

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        if (!in_array($request->getMethod(), static::ALLOWED, true)) {
            $response->write('Method not allowed');
            return $response
                ->withStatus(405)
                ->withHeader('Content-type', 'text/plain')
                ->withHeader('Allow', implode(', ', static::ALLOWED));
        }

        if (static::OVERRIDE === true) {
            return $response;
        }
        if (!$this->requestHasRequiredParameters($request)) {
            return $this->createBadRequestResponse($response);
        }
        return $this->handle($request, $response, $arguments);
    }

    public function requestHasRequiredParameters(ServerRequestInterface $request): bool
    {
        $parameters = $request->getParsedBody() ?? [];
        foreach (static::REQUIRED_VALUES as $requiredValue) {
            if (!array_key_exists($requiredValue, $parameters)) {
                return false;
            }
        }
        return true;
    }
    protected function createBadRequestResponse(ResponseInterface $response): ResponseInterface
    {
        $response->write('Bad request');
        return $response
            ->withHeader('Content-type', 'text/plain')
            ->withStatus(400);
    }

    abstract protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface;
}
