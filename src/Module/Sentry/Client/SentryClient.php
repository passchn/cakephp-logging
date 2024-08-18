<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry\Client;

use Passchn\CakeLogging\Module\Sentry\ValueObject\SentryLogEntry;

final class SentryClient
{
    public function log(SentryLogEntry $logEntry): void
    {
        // todo send log to sentry
        throw new SentryClientException('Not implemented');
    }
}