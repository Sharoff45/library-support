<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Util;

use DateTimeImmutable;
use DateTimeZone;
use Exception;
use Sharoff45\Library\Support\Exception\DateTimeConvertException;

class DateTimeConverter
{
    /**
     * @throws DateTimeConvertException
     */
    public static function convert(string $dateTime, string $timeZone = 'Europe/Moscow'): DateTimeImmutable
    {
        if ('' === $dateTime) {
            throw new DateTimeConvertException('Bad date');
        }

        try {
            return new DateTimeImmutable($dateTime, new DateTimeZone($timeZone));
        } catch (Exception $exception) {
            throw new DateTimeConvertException(DateTimeConvertException::DEFAULT_MESSAGE, $exception);
        }
    }
}
