<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Exception;

use Exception;
use Throwable;

class DateTimeConvertException extends Exception
{
    public const DEFAULT_MESSAGE = 'Datetime convert error';

    public function __construct(string $message = self::DEFAULT_MESSAGE, ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
