<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;
use Throwable;

final class MultiLogger extends AbstractLogger
{
    /**
     * @param non-empty-list<LoggerInterface> $loggers
     */
    public function __construct(
        private readonly array $loggers,
    ) {
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $erroredLoggers = [];

        foreach ($this->loggers as $logger) {
            try {
                $logger->log($level, $message, $context);
            } catch (Throwable) {
                $erroredLoggers[] = $logger::class;
            }
        }

        if ($erroredLoggers === []) {
            return;
        }

        foreach ($this->loggers as $logger) {
            if (in_array($logger::class, $erroredLoggers, true)) {
                continue;
            }
            $logger->error(
                'Failed to log message to loggers.',
                [
                    'erroredLoggers' => $erroredLoggers,
                    'originalLevel' => $level,
                    'originalMessage' => $message,
                    'originalContext' => $context,
                ],
            );
        }
    }
}