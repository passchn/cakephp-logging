<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LoggerFacade;

use Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger\UnderlyingLoggerBuilder;
use Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger\UnderlyingLoggerBuilderFactory;
use Passchn\SimpleDI\Module\Module\ModuleInterface;

final class LoggerFacadeModule implements ModuleInterface
{
    public static function services(): array
    {
        return [
            UnderlyingLoggerBuilder::class => UnderlyingLoggerBuilderFactory::class,
        ];
    }
}