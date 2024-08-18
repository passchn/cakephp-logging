<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Redundancy\MultiLogger;

use Cake\Core\ContainerInterface;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;

final class MultiLoggerFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container): MultiLogger
    {
        /**
         * @var MultiLoggerConfig $config
         */
        $config = $container->get(MultiLoggerConfig::class);

        return new MultiLogger(
            $config->loggerClassNames,
        );
    }
}