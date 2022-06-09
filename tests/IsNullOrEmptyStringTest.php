<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\IsNullOrEmptyString;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
class IsNullOrEmptyStringTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     */
    public function testInvoke($data, bool $expected): void
    {
        $isNullOrEmptyString = new IsNullOrEmptyString();
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
            ['', true],
            [null, true],
        ];
    }

    public function testArrayFilter(): void
    {
        $data = [1, 2.1, null, 'string', new stdClass(), [], ''];
        $expected = [2 => null, 6 => ''];

        $result = array_filter($data, new IsNullOrEmptyString());

        self::assertEquals($expected, $result);
    }
}
