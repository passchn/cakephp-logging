<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\LogContext;

use Cake\Console\TestSuite\Constraint\ContentsContain;
use Passchn\CakeLogging\Module\LogContext\Contextualizer\Contextualizer;
use Passchn\CakeLogging\Module\LogContext\Contextualizer\ContextualizerFactory;
use Passchn\SimpleDI\Module\Module\ModuleInterface;

final class LogContextModule implements ModuleInterface
{
    public static function services(): array
    {
        return [
            Contextualizer::class => ContextualizerFactory::class,
        ];
    }
}