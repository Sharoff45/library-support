<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\IsNotEmptyArray;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
class IsNotEmptyArrayTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     */
    public function testInvoke($data, bool $expected): void
    {
        $isNotEmptyArray = new IsNotEmptyArray();
        self::assertEquals($expected, $isNotEmptyArray($data));
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
            [null, false],
            [[1], true],
        ];
    }

    public function testArrayFilter(): void
    {
        $data = [1, 2.1, null, 'string', new stdClass(), [], '', [1]];
        $expected = [7 => [1]];

        $result = array_filter($data, new IsNotEmptyArray());

        self::assertEquals($expected, $result);
    }
}
