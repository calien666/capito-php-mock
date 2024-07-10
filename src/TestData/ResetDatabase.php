<?php

declare(strict_types=1);

namespace Capito\TestData;

use Capito\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\DBAL\Types\Type;

// we do NOT use the database trait here, as we have to check, if file with database already exists
final class ResetDatabase
{
    public static function createDatabase(): void
    {
        if (file_exists(Configuration::getAppDir() . '/db.sqlite')) {
            return;
        }
        $connectionParams = (new DsnParser())->parse('pdo-sqlite:///' . Configuration::getAppDir() . '/db.sqlite');
        $connection = DriverManager::getConnection($connectionParams);

        $databaseDefaultValues = require_once Configuration::getAppDir() . '/data/defaultDatabase.php';
        foreach ($databaseDefaultValues as $tableName => $structure) {
            if (count ($structure['schema']) === 0) {
                continue;
            }
            $schemaManager = $connection->createSchemaManager();
            $table = new Table($tableName);
            $schema = $structure['schema'];
            foreach ($schema as $columnName => $columnType) {
                $table->addColumn($columnName, $columnType, ['notnull' => false]);
            }
            $schemaManager->createTable($table);

            foreach ($structure['values'] as $valueSet) {
                $queryBuilder = $connection->createQueryBuilder();
                array_walk($valueSet, function (&$value, $columnName) use ($queryBuilder, $schema) {
                    $value = $queryBuilder->createNamedParameter($value, Type::getType($schema[$columnName]));
                });
                $statement = $queryBuilder
                    ->insert($tableName)
                    ->values($valueSet);
                $statement->executeStatement();
            }
        }
    }
}
