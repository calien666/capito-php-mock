<?php

declare(strict_types=1);

namespace Capito;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;

trait DatabaseTrait
{
    protected Connection $connection;

    public function __construct()
    {
        $connectionParams = (new DsnParser())->parse('pdo-sqlite:///' . Configuration::getAppDir() . '/db.sqlite');
        $this->connection = DriverManager::getConnection($connectionParams);
    }
}
