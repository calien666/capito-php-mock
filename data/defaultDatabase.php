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
            'account_id' => Types::STRING,
            'id' => Types::STRING,
            'created_at' => Types::DATETIME_IMMUTABLE,
            'deleted_at' => Types::DATETIME_IMMUTABLE,
            'tutorial_shown_at' => Types::DATETIMETZ_IMMUTABLE,
            'type' => Types::INTEGER,
            'is_verified' => Types::BOOLEAN,
            'token' => Types::STRING,
        ],
        'values' => [
            [
                'email' => 'john.doe@example.com',
                'password' => 'aRandomPasswordNotForUseInPublic',
                'account_id' => 'ff3be956-41b5-49a1-a295-7c654892ea06',
                'created_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.u', '2022-08-10T00:45:08.243691'),
                'deleted_at' => null,
                'tutorial_shown_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.vp','2024-07-10T20:10:37.641Z'),
                'type' => 1,
                'is_verified' => true,
                'id' => 'capito|123',
                'token' => '01J2FDAXFVW2NHBC9G0F5CA94P'
            ],
            [
                'email' => 'jane.doe@example.com',
                'password' => 'anotherRandomPasswordNotForUseInPublic',
                'account_id' => 'e8c4b512-e348-4713-9c75-9480dd6b48cc',
                'created_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.u','2022-08-10T00:45:08.243691'),
                'deleted_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.u','2023-09-20T19:33:27.241807'),
                'tutorial_shown_at' => DateTimeImmutable::createFromFormat('Y-d-m\TH:i:s.vp','2024-07-10T20:10:37.641Z'),
                'type' => 1,
                'is_verified' => false,
                'id' => 'capito|234',
                'token' => '01J2FDBBTB0VCHRDQFM61HZ7A7'
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
            'account_id' => Types::STRING,
            'role' => Types::INTEGER,
        ],
        'values' => [
            [
                'account_id' => 'ff3be956-41b5-49a1-a295-7c654892ea06',
                'role' => 1,
            ],
            [
                'account_id' => 'e8c4b512-e348-4713-9c75-9480dd6b48cc',
                'role' => 2,
            ],
            [
                'account_id' => 'e8c4b512-e348-4713-9c75-9480dd6b48cc',
                'role' => 3,
            ],
        ],
    ],
    'token' => [
        'schema' => [
            'token' => Types::STRING,
            'user' => Types::STRING,
        ],
        'values' => [
            [
                'token' => 'FyaL8Jn3pUjrygkVAv4Z67TKuMUKLptPr2kqjvzkVedsM2C75zmp5vW6CXxzZByC',
                'user' => 'e8c4b512-e348-4713-9c75-9480dd6b48cc',
            ]
        ],
    ],
];
