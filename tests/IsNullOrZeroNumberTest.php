<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\IsNullOrZeroNumber;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
class IsNullOrZeroNumberTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     */
    public function testInvoke($data, bool $expected): void
    {
        $isNullOrEmptyString = new IsNullOrZeroNumber();
        self::assertEquals($expected, $isNullOrEmptyString($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataProvider(): array
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

    public function testArrayFilter(): void
    {
        $data = [1, 2.1, null, 'string', new stdClass(), [], '', 0, 0.0];
        $expected = [2 => null, 7 => 0, 8 => 0.0];

        $result = array_filter($data, new IsNullOrZeroNumber());

        self::assertEquals($expected, $result);
    }
}
