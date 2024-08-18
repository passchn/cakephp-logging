<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry;

use Passchn\CakeLogging\Module\Sentry\Client\SentryClient;
use Passchn\CakeLogging\Module\Sentry\Client\SentryClientFactory;
use Passchn\CakeLogging\Module\Sentry\Logger\SentryLogger;
use Passchn\CakeLogging\Module\Sentry\Logger\SentryLoggerFactory;
use Passchn\SimpleDI\Module\Module\ModuleInterface;

final class SentryModule implements ModuleInterface
{
    public static function services(): array
    {
        return [
            SentryClient::class => SentryClientFactory::class,
            SentryLogger::class => SentryLoggerFactory::class,
        ];
    }
}