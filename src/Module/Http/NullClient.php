<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Http;

use Passchn\CakeLogging\ValueObject\LogEntry;

final class NullClient implements ClientInterface
{
    public function log(LogEntry $logEntry): void
    {
        // does nothing
    }
}