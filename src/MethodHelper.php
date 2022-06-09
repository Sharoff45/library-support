<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support;

final class MethodHelper
{
    public static function isSetter(string $name): bool
    {
        return strStartsWith($name, 'set')
            && self::checkUpperLetter($name, 3);
    }

    public static function isAdder(string $name): bool
    {
        return strStartsWith($name, 'add')
            && self::checkUpperLetter($name, 3);
    }

    public static function isGetter(string $name): bool
    {
        return strStartsWith($name, 'get')
            && self::checkUpperLetter($name, 3);
    }

    public static function IsLogic(string $name): bool
    {
        $isStartFromIs = strStartsWith($name, 'is')
            && self::checkUpperLetter($name, 2);

        $isStartFromGetIs = strStartsWith($name, 'getIs')
            && self::checkUpperLetter($name, 5);

        return $isStartFromIs || $isStartFromGetIs;
    }

    private static function checkUpperLetter(string $string, int $position): bool
    {
        return strtoupper($string[$position]) === $string[$position];
    }
}
