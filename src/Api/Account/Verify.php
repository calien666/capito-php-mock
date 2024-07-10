<?php

declare(strict_types=1);

namespace Capito\Api\Account;

use Capito\Authorization\AuthorizeAccountId;
use Capito\DatabaseTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class TriggerVerification extends AuthorizeAccountId
{
    use DatabaseTrait;

    protected const array ALLOWED = [
        'POST',
    ];

    protected const array REQUIRED_VALUES = [
        'token',
    ];

    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        $params = $request->getParsedBody();
        $token = $params['token'] ?? '';
        if (strlen($token) === 0) {
            $response->write('Bad request');
            return $response
                ->withStatus(400)
                ->withHeader('Content-Type', 'text/plain');
        }

        $queryBuilder = $this->connection->createQueryBuilder();

        $statement = $queryBuilder
            ->select('*')
            ->from('token')
            ->join(
                'token',
                'users',
                'users',
                'users.account_id = token.user'
            )
            ->where('token.token', $queryBuilder->createNamedParameter($token))
            ->setMaxResults(1);
        $result = $statement->executeQuery()->fetchOne();
        if ($result === false) {
            $response->write('Not Found (token does not exist)');
            return $response
                ->withStatus(404)
                ->withHeader('Content-Type', 'text/plain');
        }

        return $response
            ->withStatus(204);
    }
}
