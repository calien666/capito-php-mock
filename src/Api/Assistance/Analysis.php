<?php

declare(strict_types=1);

namespace Capito\Api\Assistance;

use Capito\Authorization\AuthorizeAccountId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class Analysis extends AuthorizeAccountId
{
    protected const array ALLOWED = [
        'OPTIONS',
        'PUT',
    ];

    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        $analysis = [
            'issues' => [
                [
                    'id' => 'issue-trademark-spelling-summary',
                    'metadata' => [
                        'category' => 'vocabulary',
                        'severity' => 'warning',
                    ],
                    'locations' => [
                        [
                            'start' => 51,
                            'length' => 13,
                        ]
                    ],
                    'suggestions' => [
                        [
                            'transformations' => [
                                [
                                    'location' => [
                                        'start' => 51,
                                        'length' => 13,
                                    ],
                                    'content' => 'capito digital',
                                ],
                            ],
                            'confidence' => 'low',
                            'recommended_actions' => [
                                'apply-transformations',
                            ],
                            'description' => 'Incorrect spelling of trademark.',
                        ],
                    ],
                ],
            ],
        ];

        return $response->withJson($analysis);
    }
}
