<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger;

use Cake\Core\ContainerInterface;
use Cake\Log\Engine\BaseLog;
use Psr\Log\LoggerInterface;

final class UnderlyingLoggerFactory
{
    public function __construct(
        private readonly ContainerInterface $container,
    ) {
    }

    /**
     * @param class-string<LoggerInterface> $loggerClassName
     */
    public function createLogger(string $loggerClassName): LoggerInterface
    {
        if ($this->container->has($loggerClassName)) {
            return $this->container->get($loggerClassName);
        }

        if (is_a($loggerClassName, BaseLog::class, true)) {
            return $this->createBaseLog($loggerClassName);
        }

        throw new \RuntimeException('Logger not found');
    }

    /**
     * @param class-string<BaseLog> $loggerClassName
     */
    private function createBaseLog(string $loggerClassName): BaseLog
    {
        return new $loggerClassName();
    }
}