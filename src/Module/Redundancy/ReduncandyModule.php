<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy;

use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLogger;
use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLoggerConfig;
use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLoggerConfigFactory;
use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLoggerFactory;
use Passchn\SimpleDI\Module\Module\ModuleInterface;

final class ReduncandyModule implements ModuleInterface
{
    public static function services(): array
    {
        return [
            MultiLogger::class => MultiLoggerFactory::class,
            MultiLoggerConfig::class => MultiLoggerConfigFactory::class,
        ];
    }
}