<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\IsEmptyArray;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
class IsEmptyArrayTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     */
    public function testInvoke($data, bool $expected): void
    {
        $isEmptyArray = new IsEmptyArray();
        self::assertEquals($expected, $isEmptyArray($data));
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
            [[], true],
            ['', false],
            [null, false],
        ];
    }

    public function testArrayFilter(): void
    {
        $data = [1, 2.1, null, 'string', new stdClass(), [], ''];
        $expected = [5 => []];

        $result = array_filter($data, new IsEmptyArray());

        self::assertEquals($expected, $result);
    }
}
