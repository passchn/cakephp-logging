<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LogContext\Contextualizer;

use Cake\Core\ContainerInterface;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;

final class ContextualizerFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container)
    {
        return new Contextualizer();
    }
}