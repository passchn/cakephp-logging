<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Cake\Core\ContainerInterface;
use Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger\UnderlyingLoggerFactory;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;

final class MultiLoggerFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container): MultiLogger
    {
        /**
         * @var MultiLoggerConfig $config
         */
        $config = $container->get(MultiLoggerConfig::class);

        /**
         * @var UnderlyingLoggerFactory $underlyingLoggerFactory
         */
        $underlyingLoggerFactory = $container->get(UnderlyingLoggerFactory::class);
        
        return new MultiLogger(
            array_map(
                fn(string $loggerClassName) => $underlyingLoggerFactory->createLogger($loggerClassName),
                $config->loggerClassNames,
            ),
        );
    }
}