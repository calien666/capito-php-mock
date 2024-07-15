<?php

declare(strict_types=1);

/**
 * Default Database schema
 * Main array key: table name
 * @return array<non-empty-string, array{
 *     schema: array<non-empty-string, Types>,
 *     values: array<array-key, array<non-empty-string, mixed>
 * }>
 * @example 'users' => [
 *     'schema' => [
 *         'email' => Types::STRING,
 *         'password' => Types::STRING,
 *         'account_id' => Types::STRING,
 *         'role' => Types::STRING,
 *     ],
 *     'values' => [
 *         [
 *             'email' => 'john.doe@example.com',
 *             'password' => 'high-secure-pa55w0rd',
 *             'account_id'=> '12345-refasa-fdsfserwe-fsdrwef',
 *             'role'=> 'member',
 *         ],
 *         [
 *             (...)
 *         ],
 *     ],
 * ];
 *
 */

use Doctrine\DBAL\Types\Types;

return [
    'users' => [
        'schema' => [
            'email' => Types::STRING,
            'password' => Types::STRING,
            'name' => Types::STRING,
            'id' => Types::STRING,
            'created_at' => Types::DATETIME_IMMUTABLE,
            'deleted_at' => Types::DATETIME_IMMUTABLE,
            'tutorial_shown_at' => Types::DATETIMETZ_IMMUTABLE,
            'type' => Types::INTEGER,
            'is_verified' => Types::BOOLEAN,
            'bearer' => Types::STRING,
        ],
        'values' => [
            [
                'email' => 'john.doe@example.com',
                'password' => 'aRandomPasswordNotForUseInPublic',
                'name' => 'John Doe',
                'created_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.u', '2022-08-10T00:45:08.243691'),
                'deleted_at' => null,
                'tutorial_shown_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.vp','2024-07-10T20:10:37.641Z'),
                'type' => 1,
                'is_verified' => true,
                'id' => 'auth0|clylhwu7p0001ve50eury78rd',
                'bearer' => 'f0bc01d4-90fa-43b8-b22c-1b4cba62075c',
            ],
            [
                'email' => 'jane.doe@example.com',
                'password' => 'anotherRandomPasswordNotForUseInPublic',
                'name' => 'Jane Doe',
                'created_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.u','2022-08-10T00:45:08.243691'),
                'deleted_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.u','2023-09-20T19:33:27.241807'),
                'tutorial_shown_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.vp','2024-07-10T20:10:37.641Z'),
                'type' => 1,
                'is_verified' => false,
                'id' => 'auth0|clylhy1m70002ve50r17rptyd',
                'bearer' => '6e2a203d-e830-4775-a1d8-c828511712fa',
            ],
        ],
    ],
    'type' => [
        'schema' => [
            'id' => Types::INTEGER,
            'type' => Types::STRING,
        ],
        'values' => [
            [
                'id' => 1,
                'type' => 'user',
            ],
        ],
    ],
    'roles' => [
        'schema' => [
            'id' => Types::INTEGER,
            'role' => Types::STRING,
        ],
        'values' => [
            [
                'id' => 1,
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'role' => 'member',
            ],
            [
                'id' => 3,
                'role' => 'unverified',
            ],
        ]
    ],
    'users_roles' => [
        'schema' => [
            'user_id' => Types::STRING,
            'role' => Types::INTEGER,
            'team_id' => Types::INTEGER,
        ],
        'values' => [
            [
                'user_id' => 'auth0|clylhwu7p0001ve50eury78rd',
                'role' => 1,
                'team_id' => 1,
            ],
            [
                'user_id' => 'auth0|clylhwu7p0001ve50eury78rd',
                'role' => 2,
                'team_id' => 1,
            ],
            [
                'user_id' => 'auth0|clylhy1m70002ve50r17rptyd',
                'role' => 2,
                'team_id' => 1,
            ],
            [
                'user_id' => 'auth0|clylhy1m70002ve50r17rptyd',
                'role' => 3,
                'team_id' => 1,
            ],
        ],
    ],
    'token' => [
        'schema' => [
            'token' => Types::STRING,
            'user_id' => Types::STRING,
        ],
        'values' => [
            [
                'token' => 'FyaL8Jn3pUjrygkVAv4Z67TKuMUKLptPr2kqjvzkVedsM2C75zmp5vW6CXxzZByC',
                'user_id' => 'auth0|clylhy1m70002ve50r17rptyd',
            ]
        ],
    ],
    'team' => [
        'schema' => [
            'uid' => Types::INTEGER,
            'id' => Types::STRING,
            'name' => Types::STRING,
        ],
        'values' => [
            [
                'uid' => 1,
                'id' => 'capitoAI|clyli08340003ve50336lhapn',
                'name' => 'The Does',
            ],
        ],
    ],
    'users_teams' => [
        'schema' => [
            'user_id' => Types::STRING,
            'team_id' => Types::INTEGER,
        ],
        'values' => [
            [
                'user_id' => 'auth0|clylhwu7p0001ve50eury78rd',
                'team_id' => 1,
            ],
            [
                'user_id' => 'auth0|clylhy1m70002ve50r17rptyd',
                'team_id' => 1,
            ]
        ]
    ]
];
