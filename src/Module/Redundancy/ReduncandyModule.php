<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy;

use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLoggerBuilder;
use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLoggerBuilderFactory;
use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLoggerConfig;
use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLoggerConfigFactory;
use Passchn\SimpleDI\Module\Module\ModuleInterface;

final class ReduncandyModule implements ModuleInterface
{
    public static function services(): array
    {
        return [
            MultiLoggerBuilder::class => MultiLoggerBuilderFactory::class,
            MultiLoggerConfig::class => MultiLoggerConfigFactory::class,
        ];
    }
}