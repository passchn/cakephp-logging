<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Cake\Core\ContainerInterface;
use Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger\UnderlyingLoggerFactory;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;

final class MultiLoggerBuilderFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container): MultiLoggerBuilder
    {
        return new MultiLoggerBuilder(
            $container->get(UnderlyingLoggerFactory::class),
            $container->get(MultiLoggerConfig::class),
        );
    }
}