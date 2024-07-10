<?php

declare(strict_types=1);

namespace Capito\Api\Account;

use Capito\Authorization\AuthorizeAccountId;
use Capito\DatabaseTrait;
use Capito\Model\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @verification Bearer
 * @role admin
 *
 * @api /v2/account/{account-id}/trigger-verification
 */
final readonly class TriggerVerification extends AuthorizeAccountId
{
    use DatabaseTrait;

    protected const array ALLOWED = [
        'POST',
    ];

    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        /** @var User|null $user */
        $user = $request->getAttribute('user');
        if ($user === null || $user->isAdmin() === false) {
            return $response
                ->withStatus(401)
                ->withJson([
                    'property' => 'header::Authorization',
                    'message' => 'Authorization-Header either missing or empty'
                ]);
        }

        $accountId = $arguments['account-id'];
        $queryBuilder = $this->connection->createQueryBuilder();
        $query = $queryBuilder
            ->select('*')
            ->from('users')
            ->where(
                $queryBuilder->expr()->eq('accountId', $queryBuilder->createNamedParameter($accountId))
            )
            ->setMaxResults(1);
        $result = $query->executeQuery();
        $row = $result->fetchAssociative();
        if ($row === false) {
            // @todo check API, if user account id is really non-existing
            //       and which status is returned then
            $response->write('Bad request');
            return $response
                ->withStatus(400)
                ->withHeader('Content-Type', 'text/plain');
        }

        // user already verified, return conflict
        if ($row['is_verified']) {
            $response->write('Conflict (account is already verified)');
            return $response
                ->withStatus(409)
                ->withHeader('Content-Type', 'text/plain');
        }

        // as we can't mock the email send of verification mail,
        // just return 204 as successful response
        return $response->withStatus(204);
    }
}
