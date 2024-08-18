<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger;

use Cake\Core\ContainerInterface;
use Cake\Log\Engine\BaseLog;
use Passchn\CakeLogging\Module\LoggerFacade\LoggerFacade;
use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLogger;
use Passchn\CakeLogging\Module\Redundancy\MultiLogger\MultiLoggerBuilder;
use Psr\Log\LoggerInterface;

final readonly class UnderlyingLoggerFactory
{
    public function __construct(
        private ContainerInterface $container,
    ) {
    }

    /**
     * @param class-string<LoggerInterface> $loggerClassName
     */
    public function createLogger(string $loggerClassName, array $config): LoggerInterface
    {
        if (is_a($loggerClassName, LoggerFacade::class, true)) {
            throw new \LogicException('LoggerFacade must not be used as an underlying logger');
        }

        if ($this->container->has($loggerClassName)) {
            return $this->container->get($loggerClassName);
        }

        if (is_a($loggerClassName, BaseLog::class, true)) {
            return $this->createBaseLog($loggerClassName, $config);
        }

        if (is_a($loggerClassName, MultiLogger::class, true)) {
            /**
             * @var MultiLoggerBuilder $multiLoggerBuilder
             */
            $multiLoggerBuilder = $this->container->get(MultiLoggerBuilder::class);

            return $multiLoggerBuilder->build($config);
        }

        throw new \RuntimeException('Logger not found');
    }

    /**
     * @param class-string<BaseLog> $loggerClassName
     */
    private function createBaseLog(string $loggerClassName, array $config): BaseLog
    {
        return new $loggerClassName($config);
    }
}