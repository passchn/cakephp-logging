<?php
declare(strict_types=1);

namespace Passchn\CakeLogging;

use Cake\Core\BasePlugin;
use Cake\Core\ContainerInterface;
use Passchn\CakeLogging\Module\LogContext\LogContextModule;
use Passchn\CakeLogging\Module\LoggerFacade\LoggerFacadeModule;
use Passchn\CakeLogging\Module\Redundancy\ReduncandyModule;
use Passchn\CakeLogging\Module\Sentry\SentryModule;
use Passchn\SimpleDI\Module\DI\DIManager;
use Passchn\SimpleDI\Module\Plugin\PluginInterface;

/**
 * Plugin for SimpleDI
 */
final class CakeLoggingPlugin extends BasePlugin implements PluginInterface
{
    public function services(ContainerInterface $container): void
    {
        DIManager
            ::create($container)
            ->addPlugin(self::class);
    }

    public static function modules(): array
    {
        return [
            LogContextModule::class,
            LoggerFacadeModule::class,
            ReduncandyModule::class,
            SentryModule::class,
        ];
    }
}
