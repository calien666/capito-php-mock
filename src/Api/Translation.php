<?php

declare(strict_types=1);

namespace Capito\Api;

use Capito\Authorization\AuthorizeAccountId;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final readonly class Translation extends AuthorizeAccountId
{
    protected const array ALLOWED = [
        'OPTIONS',
        'PUT',
    ];
    protected function handle(ServerRequestInterface $request, ResponseInterface $response, array $arguments): ResponseInterface
    {
        $translation = [
            'content' => 'This document showcases the incredible features of capitoDigital.\nStarting with the analysis of text to look for issues concerning the text\'s\naccessibility; and ending with automated simplification based on machine-learning\nand sophisticated algorithms, developed in-house by our own experts in\ncomputer linguistic. Why may one ask? Because this is our goal: Help people\nunderstand!',
        ];
        return $response->withJson($translation);
    }
}
