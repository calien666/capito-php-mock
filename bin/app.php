<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$console = new Application('capito mock API server', '2.2.0');
$console->add(new \Capito\Console\ResetDatabaseCommand());
$console->run();
