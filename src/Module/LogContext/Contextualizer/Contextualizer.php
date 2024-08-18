<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LogContext\Contextualizer;

use Passchn\CakeLogging\ValueObject\LogEntry;
use Stringable;

final class Contextualizer
{
    public function buildFromBasicLog($level, Stringable|string $message, array $context = []): LogEntry
    {
        return new LogEntry();
    }
}