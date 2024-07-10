<?php

declare(strict_types=1);

namespace Capito\Api\Assistance;

use Capito\Authorization\AuthorizeAccountId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class Lexicon extends AuthorizeAccountId
{
    protected const array ALLOWED = [
        'OPTIONS',
        'PUT',
    ];

    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        $lexicon = [
            'entries' => [
                [
                    'locations' => [
                        [
                            'start' => 51,
                            'length' => 13,
                        ],
                    ],
                    'description' => '\'capito digital\'\' is a product of the atempo GesmbH aimed at \nhelping write understandable texts.',
                ],
            ],
        ];
        return $response->withJson($lexicon);
    }
}
