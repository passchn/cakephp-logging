<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry\Client;

use Passchn\CakeLogging\Module\Http\ClientInterface;
use Passchn\CakeLogging\ValueObject\LogEntry;

final class SentryClient implements ClientInterface
{
    public function log(LogEntry $logEntry): void
    {
        // todo send log to sentry
        throw new SentryClientException('Not implemented');
    }
}