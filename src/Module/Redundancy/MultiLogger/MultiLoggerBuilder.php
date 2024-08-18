<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger\UnderlyingLoggerBuilder;

final class MultiLoggerBuilder
{
    public function __construct(
        private readonly UnderlyingLoggerBuilder $underlyingLoggerFactory,
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
                fn(string $loggerClassName) => $this->underlyingLoggerFactory->buildLogger($loggerClassName, $baseLogConfig),
                $multiLoggerConfig->loggerClassNames,
            ),
        );
    }
}