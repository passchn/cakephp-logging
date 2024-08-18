<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LoggerFacade\UnderlyingLogger;

use Cake\Core\ContainerInterface;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;

final class UnderlyingLoggerBuilderFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container): UnderlyingLoggerBuilder
    {
        return new UnderlyingLoggerBuilder($container);
    }
}