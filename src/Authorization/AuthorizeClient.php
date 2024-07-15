<?php

declare(strict_types=1);

namespace Capito\Authorization;

use Capito\DatabaseTrait;
use Capito\Model\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Http\ServerRequest;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;

class AuthorizeClient implements MiddlewareInterface
{
    use DatabaseTrait;

    private const array IGNORE_VALIDATION = [
        '/v2/account',
        '/v2/account/verify',
    ];
    /**
     * @param ServerRequest $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $apiPath = $request->getRequestTarget();
        if (!in_array($apiPath, self::IGNORE_VALIDATION, true)) {
            $authHeader = $request->getHeader('Authorization')[0] ?? '';
            if (!str_starts_with($authHeader, 'Bearer ')) {
                return $this->createUnauthorizedResponse();
            }

            $token = substr($authHeader, strlen('Bearer '));
            if (strlen($token) === 0) {
                return $this->createUnauthorizedResponse();
            }

            $queryBuilder = $this->connection->createQueryBuilder();
            $query = $queryBuilder
                ->select('users.*', 'GROUP_CONCAT(roles.role) AS role')
                ->from('users')
                ->join(
                    'users',
                    'users_roles',
                    'users_roles',
                    'users.id=users_roles.user_id'
                )
                ->join(
                    'users_roles',
                    'roles',
                    'roles',
                    'users_roles.role=roles.id'
                )
                ->where($queryBuilder->expr()->eq('users.bearer', $queryBuilder->createNamedParameter($token)))
                ->setMaxResults(1);
            $row = $query->executeQuery()->fetchAssociative();
            if ($row === false) {
                return $this->createUnauthorizedResponse();
            }

            $roles = explode(',', $row['role']);
            $user = new User(
                $row['email'],
                $row['password'],
                $row['account_id'],
                $row['id'],
                in_array('admin', $roles, true),
                in_array('member', $roles, true),
                $row['is_verified'] === 1 || $row['is_verified'] === true
            );
            $request = $request->withAttribute('user', $user);
        }

        return $handler->handle($request);
    }

    private function createUnauthorizedResponse(): ResponseInterface
    {
        return (new ResponseFactory())
            ->createResponse(401, 'Unauthorized')
            ->withHeader('Content-Type', 'application/json')
            ->withBody(
                (new StreamFactory())
                    ->createStream(json_encode([
                        'property' => 'header::Authorization',
                        'message' => 'Authorization-Header either missing or empty'
                    ]))
            );
    }
}
