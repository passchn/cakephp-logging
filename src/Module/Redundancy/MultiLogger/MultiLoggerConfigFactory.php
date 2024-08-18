<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Cake\Core\ContainerInterface;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;

final class MultiLoggerConfigFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container)
    {
        return MultiLoggerConfig::fromConfigKey(MultiLoggerConfig::class);
    }
}