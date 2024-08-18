<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Http;

use Passchn\CakeLogging\Module\Http\Exception\ClientExceptionInterface;
use Passchn\CakeLogging\ValueObject\LogEntry;

interface ClientInterface
{
    /**
     * @throws ClientExceptionInterface
     */
    public function log(LogEntry $logEntry): void;
}