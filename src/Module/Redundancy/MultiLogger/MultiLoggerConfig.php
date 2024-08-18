<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Cake\Core\Configure;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;

final class MultiLoggerConfig
{
    public const CONFIG_KEY_LOGGERS = 'loggers';

    /**
     * @param non-empty-list<class-string<LoggerInterface>> $loggerClassNames
     */
    private function __construct(
        public readonly array $loggerClassNames,
    ) {
    }

    public static function fromConfigKey(string $configKey): self
    {
        return new MultiLoggerConfig(
            self::getValidatedLoggersConfig(
                Configure::readOrFail($configKey . '.' . self::CONFIG_KEY_LOGGERS),
            ),
        );
    }

    /**
     * @return list<class-string<LoggerInterface>>
     */
    private static function getValidatedLoggersConfig($loggers): array
    {
        if (!is_array($loggers) || !array_is_list($loggers)) {
            throw new InvalidArgumentException('loggers must be a list');
        }

        if ($loggers === []) {
            throw new InvalidArgumentException('loggers must not be empty');
        }

        foreach ($loggers as $logger) {
            if (!is_string($logger)) {
                throw new InvalidArgumentException('loggers must be a list of strings');
            }
            if (!is_a($logger, LoggerInterface::class, true)) {
                throw new InvalidArgumentException('loggers must be a list of class-strings that implement LoggerInterface');
            }
        }

        return $loggers;
    }

    public function withMergedConfig(array $config): self
    {
        if (array_key_exists(self::CONFIG_KEY_LOGGERS, $config)) {
            $loggers = self::getValidatedLoggersConfig($config[self::CONFIG_KEY_LOGGERS]);
        }

        return new MultiLoggerConfig(
            $loggers ?? $this->loggerClassNames,
        );
    }
}