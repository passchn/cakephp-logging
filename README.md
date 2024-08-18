# Logging plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```sh
composer require passchn/cakephp-logging
```

Load the plugin:

```sh
bin/cake plugin load Passchn/CakeLogging
```

## Usage

The plugin enables you to configure the Cake Log class to use implementations of the PSR-3 logger interface which are
available
in your Applications container.

It comes with a MultiLogger where you can define multiple implementations as fallbacks.

### Configuration

In your `config/app.php` you can configure the logger like this:

```php

return [
    'Log' => [
        'debug' => [
            'className' => LoggerFacade::class, // use the facade to configure the actual logger
            LoggerFacade::CONFIG_KEY_UNDERLYING_LOGGER => MyLoggerImplementation::class, // a LoggerInterface implementation
        ],
    ],
];
```

Note that `MyLoggerImplementation` must be available in your container.

### MultiLogger usage

You can also use the MultiLogger to define multiple fallbacks:

```php
return [
    
    // default config for the multi logger
    MultiLoggerConfig::class => [
        MultiLoggerConfig::CONFIG_KEY_LOGGERS => [
            SentryLogger::class,
            FileLog::class,
        ],
    ],
    
    'Log' => [
        'debug' => [
            'className' => LoggerFacade::class,
            LoggerFacade::CONFIG_KEY_UNDERLYING_LOGGER => MultiLogger::class,
            MultiLoggerConfig::class => [
                // multi logger config can be overridden here
                MultiLoggerConfig::CONFIG_KEY_LOGGERS => [
                    MyLoggerImplementation::class,
                    AnotherLoggerImplementation::class,
                    FileLog::class, // the default file logger as fallback
                ],
            ],
            'path' => LOGS,
            'file' => 'debug',
            'url' => env('LOG_DEBUG_URL', null),
            'scopes' => null,
            'levels' => ['notice', 'info', 'debug'],
        ],
        
        'error' => [
            // ...
        ],
        
        'emergency' => [
            'className' => FileLog::class,
            'className' => LoggerFacade::class,
            LoggerFacade::CONFIG_KEY_UNDERLYING_LOGGER => MultiLogger::class,
            MultiLoggerConfig::CONFIG_KEY_LOGGERS => [
                SmsEmergencyLogger::class,
                AlexaTextToSpeechAlarmWithWaterSprinklerLogger::class,
            ],
        ],
    ],
];
```

If you use the default FileLogger, leave the config keys as they are as they will be used for the FileLog configuration.

Every logger used by the multi logger must be an implementation of the LoggerInterface which is available in your
container.
