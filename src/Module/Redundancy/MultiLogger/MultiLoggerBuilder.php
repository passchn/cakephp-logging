<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger\UnderlyingLoggerFactory;

final class MultiLoggerBuilder
{
    public function __construct(
        private readonly UnderlyingLoggerFactory $underlyingLoggerFactory,
        private readonly MultiLoggerConfig       $multiLoggerConfig,
    ){
    }

    public function build(
        array $baseLogConfig,
    ): MultiLogger
    {
        return new MultiLogger(
            array_map(
                fn(string $loggerClassName) => $this->underlyingLoggerFactory->createLogger($loggerClassName, $baseLogConfig),
                $this->multiLoggerConfig->loggerClassNames,
            ),
        );
    }
}