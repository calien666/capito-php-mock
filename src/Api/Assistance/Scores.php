<?php

declare(strict_types=1);

namespace Capito\Api\Assistance;

use Capito\Authorization\AuthorizeAccountId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class Scores extends AuthorizeAccountId
{
    protected const array ALLOWED = [
        'OPTIONS',
        'PUT'
    ];
    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        $returnValue = [
            'a1' => [
                'combined' => 20,
            ],
            'a2' => [
                'combined' => 59,
            ],
            'b1' => [
                'combined' => 93,
            ],
        ];
        return $response->withJson($returnValue);
    }
}
