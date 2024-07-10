<?php

declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

use Capito\Api\Account\NewAccount;
use Capito\Api\Account\Verify;
use Capito\Api\Assistance\Analysis;
use Capito\Api\Assistance\Lexicon;
use Capito\Api\Assistance\Scores;
use Capito\Api\Assistance\Tokens;
use Capito\Api\Translation;
use Capito\Authorization\AuthorizeClient;
use Slim\Factory\AppFactory;

// Instantiate App
$app = AppFactory::create();
$app->addMiddleware((new AuthorizeClient()));

$app->any('/v2/account', NewAccount::class);
$app->any('/v2/account/verify', Verify::class);
$app->any('/v2/assistance/{account-id}/analysis', Analysis::class);
$app->any('/v2/assistance/{account-id}/lexicon', Lexicon::class);
$app->any('/v2/assistance/{account-id}/scores', Scores::class);
$app->any('/v2/assistance/{account-id}/tokens', Tokens::class);
$app->any('/v2/translation/{account-id}', Translation::class);
// finally, answer with 404 to all not routed requests

$app->any('/[{.*}]', [\Capito\Application::class, 'failure']);

$app->run();
