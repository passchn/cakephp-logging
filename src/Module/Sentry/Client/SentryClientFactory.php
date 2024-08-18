<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry\Client;

use Cake\Core\ContainerInterface;
use Passchn\SimpleDI\Module\DI\Factory\InvokableFactoryInterface;

final class SentryClientFactory implements InvokableFactoryInterface
{
    public function __invoke(ContainerInterface $container): SentryClient
    {
        return new SentryClient();
    }
}