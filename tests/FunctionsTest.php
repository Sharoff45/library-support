<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\IsNotNull;
use Sharoff45\Library\Support\IsNull;
use PHPUnit\Framework\TestCase;
use stdClass;
use function Sharoff45\Library\Support\all;
use function Sharoff45\Library\Support\isEmptyArray;
use function Sharoff45\Library\Support\isEmptyArrayFilter;
use function Sharoff45\Library\Support\isNotEmptyArray;
use function Sharoff45\Library\Support\isNotEmptyArrayFilter;
use function Sharoff45\Library\Support\isNotEmptyString;
use function Sharoff45\Library\Support\isNotNull;
use function Sharoff45\Library\Support\isNull;
use function Sharoff45\Library\Support\isNullOrEmptyString;
use function Sharoff45\Library\Support\isNullOrZeroNumber;
use function Sharoff45\Library\Support\objectToArray;
use function Sharoff45\Library\Support\strStartsWith;

/**
 * @internal
 */
class FunctionsTest extends TestCase
{
    /**
     * @dataProvider dataIsEmptyArray
     *
     * @param mixed $data
     */
    public function testIsEmptyArray($data, bool $expected): void
    {
        self::assertEquals($expected, isEmptyArray($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsEmptyArray(): array
    {
        return [
            [1, false],
            [1.1, false],
            ['1', false],
            ['string', false],
            [new stdClass(), false],
            [[], true],
            ['', false],
            [null, false],
        ];
    }

    /**
     * @dataProvider dataIsNotEmptyArray
     *
     * @param mixed $data
     */
    public function testIsNotEmptyArray($data, bool $expected): void
    {
        self::assertEquals($expected, isNotEmptyArray($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsNotEmptyArray(): array
    {
        return [
            [1, false],
            [1.1, false],
            ['1', false],
            ['string', false],
            [new stdClass(), false],
            [[], false],
            ['', false],
            [null, false],
            [[1], true],
        ];
    }

    /**
     * @dataProvider dataIsNotEmptyString
     *
     * @param mixed $data
     */
    public function testIsNotEmptyString($data, bool $expected): void
    {
        self::assertEquals($expected, isNotEmptyString($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsNotEmptyString(): array
    {
        return [
            [1, false],
            [1.1, false],
            ['1', true],
            ['string', true],
            [new stdClass(), false],
            [[], false],
            ['', false],
            [null, false],
        ];
    }

    /**
     * @dataProvider dataIsNotNull
     *
     * @param mixed $data
     */
    public function testIsNotNull($data, bool $expected): void
    {
        self::assertEquals($expected, isNotNull($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsNotNull(): array
    {
        return [
            [1, true],
            [1.1, true],
            ['1', true],
            ['string', true],
            [new stdClass(), true],
            [[], true],
            ['', true],
            [null, false],
        ];
    }

    /**
     * @dataProvider dataIsNullOrEmptyString
     *
     * @param mixed $data
     */
    public function testIsNullOrEmptyString($data, bool $expected): void
    {
        self::assertEquals($expected, isNullOrEmptyString($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsNullOrEmptyString(): array
    {
        return [
            [1, false],
            [1.1, false],
            ['1', false],
            ['string', false],
            [new stdClass(), false],
            [[], false],
            ['', true],
            [null, true],
        ];
    }

    /**
     * @dataProvider dataIsNull
     *
     * @param mixed $data
     */
    public function testIsNull($data, bool $expected): void
    {
        self::assertEquals($expected, isNull($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsNull(): array
    {
        return [
            [1, false],
            [1.1, false],
            ['1', false],
            ['string', false],
            [new stdClass(), false],
            [[], false],
            ['', false],
            [null, true],
        ];
    }

    /**
     * @dataProvider dataIsEmptyArrayFilter
     *
     * @param array<mixed> $data
     */
    public function testIsEmptyArrayFilter(array $data, bool $expected): void
    {
        self::assertEquals($expected, isEmptyArrayFilter($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsEmptyArrayFilter(): array
    {
        return [
            [[], true],
            [[0, false, ''], true],
            [[0, false, '', 1], false],
        ];
    }

    /**
     * @dataProvider dataIsNotEmptyArrayFilter
     *
     * @param array<mixed> $data
     */
    public function testIsNotEmptyArrayFilter(array $data, bool $expected): void
    {
        self::assertEquals($expected, isNotEmptyArrayFilter($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsNotEmptyArrayFilter(): array
    {
        return [
            [[], false],
            [[0, false, ''], false],
            [[0, false, '', 1], true],
        ];
    }

    /**
     * @dataProvider dataStrStartsWith
     */
    public function testStrStartsWith(string $haystack, string $needle, bool $expected): void
    {
        self::assertEquals($expected, strStartsWith($haystack, $needle));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataStrStartsWith(): array
    {
        return [
            ['getUuid', 'get', true],
            ['setUuid', 'get', false],
            ['isUuid', 'is', true],
            ['IsUuid', 'is', false],
            ['IsUuid', 'Is', true],
            ['getIsUuid', 'get', true],
            ['getIsUuid', 'is', false],
            ['getIsUuid', 'getIs', true],
            ['getIsUuid', 'getis', false],
        ];
    }

    /**
     * @dataProvider dataObjectToArray
     *
     * @param array<string, mixed> $expected
     */
    public function testObjectToArray(object $object, array $expected): void
    {
        self::assertEquals($expected, objectToArray($object));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataObjectToArray(): array
    {
        $a = new class() {
            /**
             * @var int
             */
            private $a = 1;
            /**
             * @var int
             */
            protected $b = 2;
            /**
             * @var int
             */
            public $c = 3;
        };

        return [
            [$a, [
                'a' => 1,
                'b' => 2,
                'c' => 3,
            ]],
        ];
    }

    /**
     * @dataProvider dataAll
     *
     * @param array<mixed> $items
     */
    public function testAll(array $items, callable $callback, bool $expected): void
    {
        self::assertEquals($expected, all($items, $callback));
    }

    /**
     * @return array<int|string, mixed>>
     */
    public function dataAll(): array
    {
        return [
            '<40' => [
                'items' => [1, 30, 39, 29, 10, 13],
                'callback' => static function ($item): bool {
                    return $item < 40;
                },
                'expected' => true,
            ],
            '<20' => [
                'items' => [1, 30, 39, 29, 10, 13],
                'callback' => static function ($item): bool {
                    return $item < 20;
                },
                'expected' => false,
            ],
            'all null' => [
                'items' => [null, null, null, null],
                'callback' => static function ($item): bool {
                    return null === $item;
                },
                'expected' => true,
            ],
            'all null with IsNull' => [
                'items' => [null, null, null, null],
                'callback' => new IsNull(),
                'expected' => true,
            ],
            'some null' => [
                'items' => [null, 1, null, 2],
                'callback' => static function ($item): bool {
                    return null === $item;
                },
                'expected' => false,
            ],
            'all not null' => [
                'items' => [null, null, null, null],
                'callback' => static function ($item): bool {
                    return null !== $item;
                },
                'expected' => false,
            ],
            'all not null with IsNotNull' => [
                'items' => [null, null, null, null],
                'callback' => new IsNotNull(),
                'expected' => false,
            ],
            'some not null' => [
                'items' => [null, 1, null, 2],
                'callback' => static function ($item): bool {
                    return null !== $item;
                },
                'expected' => false,
            ],
            'all numbers' => [
                'items' => [10, 1, -3, 2, 1.3],
                'callback' => static function ($item): bool {
                    return is_int($item) || is_float($item);
                },
                'expected' => true,
            ],
            'some numbers' => [
                'items' => [10, '1', '-3', 2],
                'callback' => static function ($item): bool {
                    return is_int($item) || is_float($item);
                },
                'expected' => false,
            ],
            'empty array' => [
                'items' => [],
                'callback' => static function ($item): bool {
                    return is_int($item) || is_float($item);
                },
                'expected' => true,
            ],
            'true' => [
                'items' => [1, 30, 39, 29, 10, 13],
                'callback' => static function ($item): bool {
                    return true;
                },
                'expected' => true,
            ],
            'false' => [
                'items' => [1, 30, 39, 29, 10, 13],
                'callback' => static function ($item): bool {
                    return false;
                },
                'expected' => false,
            ],
        ];
    }

    /**
     * @dataProvider dataIsNullOrOrZeroNumber
     *
     * @param mixed $data
     */
    public function testIsNullOrZeroNumber($data, bool $expected): void
    {
        self::assertEquals($expected, isNullOrZeroNumber($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataIsNullOrOrZeroNumber(): array
    {
        return [
            [1, false],
            [1.1, false],
            ['1', false],
            ['string', false],
            [new stdClass(), false],
            [[], false],
            ['', false],
            [null, true],
            [0, true],
            [0.0, true],
        ];
    }
}
