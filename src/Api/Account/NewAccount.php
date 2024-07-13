<?php

declare(strict_types=1);

namespace Capito\Api\Account;

use Capito\Api\Account\AbstractAccount;
use Capito\DatabaseTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @verification none
 * @api /v2/account
 */
final class NewAccount extends AbstractAccount
{
    use DatabaseTrait;

    protected const array ALLOWED = [
        'PUT',
    ];

    protected const array REQUIRED_VALUES = [
        'email',
        'password',
    ];

    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        $parameters = $request->getParsedBody() ?? [];
        $email = filter_var($parameters['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = $parameters['password'] ?? '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !strlen($password)) {
            $response->write('Bad request');
            return $response->withHeader('Content-Type', 'text/plain')->withStatus(400);
        }

        $queryBuilder = $this->connection->createQueryBuilder();
        $statement = $queryBuilder
            ->select('count(*)')
            ->from('users')
            ->where('email', $queryBuilder->createNamedParameter($email));

        $result = $statement->executeQuery()->fetchNumeric();
        if ($result > 0) {
            $response->write('Conflict (account already exists)');
            return $response->withHeader('Content-Type', 'text/plain')->withStatus(409);
        }

        $response->write('Created');
        return $response->withHeader('Content-Type', 'text/plain')->withStatus(201);
    }
}
