<?php

declare(strict_types=1);

namespace Capito;

class Configuration
{
    public static function getAppDir(): string
    {
        return __DIR__ . '/../.';
    }
}
