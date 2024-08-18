<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Psr\Log\LoggerInterface;

final class MultiLoggerConfig
{
    public const CONFIG_KEY_LOGGERS = 'loggers';

    /**
     * @param non-empty-list<class-string<LoggerInterface>> $loggerClassNames
     */
    public function __construct(
        public readonly array $loggerClassNames,
    ) {
    }
}