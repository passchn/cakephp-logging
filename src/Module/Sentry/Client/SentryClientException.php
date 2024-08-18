<?php

declare(strict_types=1);

namespace Passchn\CakeLogging\Module\Sentry\Client;

use Passchn\CakeLogging\Module\Http\Exception\ClientExceptionInterface;
use RuntimeException;

final class SentryClientException extends RuntimeException implements ClientExceptionInterface
{
}