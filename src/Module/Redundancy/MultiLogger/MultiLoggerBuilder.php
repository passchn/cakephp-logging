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
        $multiLoggerConfig = $this->multiLoggerConfig;

        $specialMultiLoggerConfig = $baseLogConfig[MultiLoggerConfig::class] ?? null;
        if (is_array($specialMultiLoggerConfig)) {
            $multiLoggerConfig = $multiLoggerConfig->withMergedConfig($baseLogConfig[MultiLoggerConfig::class]);
        }

        return new MultiLogger(
            array_map(
                fn(string $loggerClassName) => $this->underlyingLoggerFactory->createLogger($loggerClassName, $baseLogConfig),
                $multiLoggerConfig->loggerClassNames,
            ),
        );
    }
}