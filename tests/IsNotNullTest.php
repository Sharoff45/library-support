<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\IsNotNull;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
class IsNotNullTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     */
    public function testInvoke($data, bool $expected): void
    {
        $isNotNull = new IsNotNull();
        self::assertEquals($expected, $isNotNull($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataProvider(): array
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

    public function testArrayFilter(): void
    {
        $data = [1, 2.1, null, 'string', new stdClass(), [], ''];
        $expected = [0 => 1, 1 => 2.1, 3 => 'string', 4 => new stdClass(), 5 => [], 6 => ''];

        $result = array_filter($data, new IsNotNull());

        self::assertEquals($expected, $result);
    }
}
