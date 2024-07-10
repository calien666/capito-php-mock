<?php

declare(strict_types=1);

namespace Capito\Api\Account;

use Capito\AbstractRequestHandler;
use Capito\DatabaseTrait;
use Doctrine\DBAL\Types\Types;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

// don't use AuthorizeAuthId, as on this point we don't want to

/**
 * @verification none
 * @api /v2/account/verify
 */
final readonly class Verify extends AbstractRequestHandler
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

        // Fetch the verification token
        $statement = $queryBuilder
            ->select('users.*')
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

        // return 404 if token not found
        if ($result === false) {
            $response->write('Not Found (token does not exist)');
            return $response
                ->withStatus(404)
                ->withHeader('Content-Type', 'text/plain');
        }

        // update user status to verified
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->update('users')
            ->set('is_verified', $queryBuilder->createNamedParameter(true,Types::BOOLEAN))
            ->where(
                $queryBuilder->expr()->eq('account_id', $queryBuilder->createNamedParameter($result['account_id'], Types::STRING))
            )
            ->executeStatement();

        // delete token entry from database
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->delete('token')
            ->where(
                $queryBuilder->expr()->eq('user', $queryBuilder->createNamedParameter($result['account_id'])),
                $queryBuilder->expr()->eq('token', $queryBuilder->createNamedParameter($token)),
            )
            ->executeStatement();

        return $response->withStatus(204);
    }
}
