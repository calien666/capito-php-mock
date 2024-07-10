<?php

declare(strict_types=1);

namespace Capito\Api\Assistance;

use Capito\Authorization\AuthorizeAccountId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class Tokens extends AuthorizeAccountId
{
    protected const array ALLOWED = [
        'OPTIONS',
        'PUT',
    ];

    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        $tokens = [
            'tokens' => [
                [
                    'locations' => [
                        [
                            'start' => 51,
                            'length' => 13,
                        ],
                    ],
                ],
            ],
        ];
        return $response->withJson($tokens);
    }
}
