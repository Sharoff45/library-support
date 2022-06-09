<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\IsNull;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
class IsNullTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     */
    public function testInvoke($data, bool $expected): void
    {
        $isNull = new IsNull();
        self::assertEquals($expected, $isNull($data));
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
        ];
    }

    public function testArrayFilter(): void
    {
        $data = [1, 2.1, null, 'string', new stdClass(), [], ''];
        $expected = [2 => null];

        $result = array_filter($data, new IsNull());

        self::assertEquals($expected, $result);
    }
}
