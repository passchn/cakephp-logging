<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use InvalidArgumentException;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;
use Psr\Log\LoggerInterface;

final class MultiLoggerConfigFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container)
    {
        $loggers = Configure::readOrFail(MultiLoggerConfig::class . '.' . MultiLoggerConfig::CONFIG_KEY_LOGGERS);

        if (!array_is_list($loggers)) {
            throw new InvalidArgumentException('loggers must be a list');
        }

        foreach ($loggers as $logger) {
            if (!is_string($logger)) {
                throw new InvalidArgumentException('loggers must be a list of strings');
            }
            if (!is_a($logger, LoggerInterface::class, true)) {
                throw new InvalidArgumentException('loggers must be a list of class-strings that implement LoggerInterface');
            }
        }

        return new MultiLoggerConfig($loggers);
    }
}