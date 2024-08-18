<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry\Logger;

use Passchn\CakeLogging\Module\LogContext\Contextualizer\Contextualizer;
use Passchn\CakeLogging\Module\Sentry\Client\SentryClient;
use Psr\Log\AbstractLogger;

final class SentryLogger extends AbstractLogger
{
    public function __construct(
        private readonly SentryClient $client,
        private readonly Contextualizer $contextualizer,
    ) {
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->client->log(
            $this->contextualizer->buildFromBasicLog($level, $message, $context),
        );
    }
}