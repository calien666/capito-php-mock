<?php

declare(strict_types=1);

namespace Capito\Api\Account;

use Capito\Authorization\AuthorizeAccountId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @verification Bearer
 * @verification account-id
 * @role admin
 *
 * @api /v2/account/{account-id}/trigger-verification
 */
final readonly class TriggerVerification extends AuthorizeAccountId
{

    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        // TODO: Implement handle() method.
    }
}
