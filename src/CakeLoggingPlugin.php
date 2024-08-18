<?php
declare(strict_types=1);

namespace Passchn\CakeLogging;

use Cake\Core\BasePlugin;
use Cake\Core\ContainerInterface;
use Passchn\CakeLogging\Module\LoggerFacade\LoggerFacadeModule;
use Passchn\CakeLogging\Module\Redundancy\ReduncandyModule;
use Passchn\SimpleDI\Module\DI\DIManager;
use Passchn\SimpleDI\Module\Plugin\PluginInterface;
use Passchn\SimpleDI\Module\ServiceLocator\ServiceLocator;

/**
 * Plugin for SimpleDI
 */
final class CakeLoggingPlugin extends BasePlugin implements PluginInterface
{
    public function services(ContainerInterface $container): void
    {
        ServiceLocator::setContainer($container, forceReset: false);

        DIManager
            ::create($container)
            ->addPlugin(self::class);
    }

    public static function modules(): array
    {
        return [
            LoggerFacadeModule::class,
            ReduncandyModule::class,
        ];
    }
}
