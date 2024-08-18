<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Cake\Log\Log;
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
                if ($context['isMultiLoggerError'] ?? false) {
                    continue;
                }
                $erroredLoggers[] = $logger::class;
            }
        }

        if ($erroredLoggers === []) {
            return;
        }

        Log::error(
            'Failed to log message to loggers.',
            [
                'erroredLoggers' => $erroredLoggers,
                'originalLevel' => $level,
                'originalMessage' => $message,
                'originalContext' => $context,
                'isMultiLoggerError' => true,
            ],
        );
    }
}