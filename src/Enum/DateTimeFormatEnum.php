<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Enum;

use DateTime;

class DateTimeFormatEnum
{
    public const DATE = 'Y-m-d';
    public const TIME = 'H:i:s';
    public const DATE_TIME = 'Y-m-d H:i:s';
    public const DATE_TIME_ISO = 'Y-m-d\TH:i:s';
    public const DATE_AXAPTA = 'd.m.Y';
    public const DATE_TIME_AXAPTA = 'd.m.Y H:i:s';
    public const DATE_TIME_STANDART = DateTime::ATOM;
}
