<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry\Builder;

use Passchn\CakeLogging\Module\Sentry\ValueObject\SentryLogEntry;

final class LogEntryBuilder
{
    public function build($level, \Stringable|string $message, array $context = []): SentryLogEntry
    {
        return new SentryLogEntry();
    }
}