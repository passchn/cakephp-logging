<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry\Logger;

use Passchn\CakeLogging\Module\Sentry\Builder\LogEntryBuilder;
use Passchn\CakeLogging\Module\Sentry\Client\SentryClient;
use Psr\Log\AbstractLogger;

final class SentryLogger extends AbstractLogger
{
    public function __construct(
        private readonly SentryClient $client,
        private readonly LogEntryBuilder $logEntryBuilder,
    ) {
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->client->log(
            $this->logEntryBuilder->build($level, $message, $context),
        );
    }
}