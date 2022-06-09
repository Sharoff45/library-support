<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support;

/**
 * @param array<mixed> $array
 */
function isEmptyArrayFilter(array $array): bool
{
    return [] === array_filter($array);
}

/**
 * @param array<mixed> $array
 */
function isNotEmptyArrayFilter(array $array): bool
{
    return [] !== array_filter($array);
}

/**
 * @param mixed $value
 */
function isEmptyArray($value): bool
{
    return (new IsEmptyArray())($value);
}

/**
 * @param mixed $value
 */
function isNotEmptyArray($value): bool
{
    return (new IsNotEmptyArray())($value);
}

/**
 * @param mixed $value
 */
function isNotEmptyString($value): bool
{
    return (new IsNotEmptyString())($value);
}

/**
 * @param mixed $value
 */
function isNotNull($value): bool
{
    return (new IsNotNull())($value);
}

/**
 * @param mixed $value
 */
function isNull($value): bool
{
    return (new IsNull())($value);
}

/**
 * @param mixed $value
 */
function isNullOrEmptyString($value): bool
{
    return (new IsNullOrEmptyString())($value);
}

/**
 * @param mixed $value
 */
function isNullOrZeroNumber($value): bool
{
    return (new IsNullOrZeroNumber())($value);
}

/**
 * @see https://wiki.php.net/rfc/add_str_starts_with_and_ends_with_functions
 */
function strStartsWith(string $haystack, string $needle): bool
{
    return 0 === strncmp($haystack, $needle, strlen($needle));
}

/**
 * Получения данных объекта без рефлексии
 *
 * @see https://3v4l.org/adhBn
 *
 * @return array<string, mixed>
 */
function objectToArray(object $object): array
{
    return (function (): array {
        return get_object_vars($this);
    })->call($object);
}

/**
 * Возвращает TRUE, если каждый элемент массива удовлетворяет условию в $callback функции
 *
 * @param array<mixed> $items
 */
function all(array $items, callable $callback): bool
{
    return $items === array_filter($items, $callback);
}
