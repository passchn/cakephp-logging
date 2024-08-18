<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LoggerFacade;

use Cake\Core\Configure;
use Cake\Log\Engine\BaseLog;
use Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger\UnderlyingLoggerFactory;
use Passchn\SimpleDI\Module\ServiceLocator\ServiceLocator;
use Psr\Log\LoggerInterface;

/**
 * For use in the App Config, e.g. to replace the FileLog class.
 *
 * An underlying logger must be specified in the config.
 */
final class LoggerFacade extends BaseLog
{
    public const CONFIG_KEY_UNDERLYING_LOGGER = 'underlyingLogger';

    private readonly LoggerInterface $logger;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $underlyingLogger = $config[self::CONFIG_KEY_UNDERLYING_LOGGER]
            ?? Configure::read(self::class . '.' . self::CONFIG_KEY_UNDERLYING_LOGGER);

        if (!is_a($underlyingLogger, LoggerInterface::class, true)) {
            throw new \InvalidArgumentException('underlyingLogger must be a class-string that implements LoggerInterface');
        }

        $this->logger = ServiceLocator
            ::get(UnderlyingLoggerFactory::class)
            ->createLogger($underlyingLogger, $config);
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        $this->logger->log($level, $message, $context);
    }
}