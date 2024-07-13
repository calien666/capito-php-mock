<?php

declare(strict_types=1);

namespace Capito\Authorization;

use Capito\AbstractRequestHandler;
use Capito\DatabaseTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AuthorizeAccountId extends AbstractRequestHandler
{
    use DatabaseTrait;
    protected const bool OVERRIDE = true;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        $response = parent::__invoke($request, $response, $arguments);
        // parent changed response already. just return
        if ($response->getStatusCode() !== 200) {
            return $response;
        }
        $queryBuilder = $this->connection->createQueryBuilder();
        $statement = $queryBuilder
            ->select('*')
            ->from('users')
            ->where(
                $queryBuilder->expr()->eq('account_id', $queryBuilder->createNamedParameter($arguments['account-id'] ?? '')),
            )
            ->setMaxResults(1);
        $result = $statement->executeQuery();
        $row = $result->fetchAssociative();
        if ($row === false) {
            return $response->withJson(['error' => 'Invalid account id'], 401);
        }

        if (!$this->requestHasRequiredParameters($request)) {
            return $this->createBadRequestResponse($response);
        }
        return $this->handle($request, $response, $arguments);
    }
}
