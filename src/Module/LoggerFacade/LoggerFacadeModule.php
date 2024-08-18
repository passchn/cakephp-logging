<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LoggerFacade;

use Cake\Core\ContainerInterface;
use Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger\UnderlyingLoggerFactory;
use Passchn\SimpleDI\Module\Module\ModuleInterface;

final class LoggerFacadeModule implements ModuleInterface
{
    public static function services(): array
    {
        return [
            UnderlyingLoggerFactory::class => fn(ContainerInterface $container) => new UnderlyingLoggerFactory($container),
        ];
    }
}