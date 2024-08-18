<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry\Logger;

use Cake\Core\ContainerInterface;
use Passchn\CakeLogging\Module\Sentry\Builder\LogEntryBuilder;
use Passchn\CakeLogging\Module\Sentry\Client\SentryClient;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;

final class SentryLoggerFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container): SentryLogger
    {
        return new SentryLogger(
            $container->get(SentryClient::class),
            new LogEntryBuilder(),
        );
    }
}