<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\IsNotEmptyString;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
class IsNotEmptyStringTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     */
    public function testInvoke($data, bool $expected): void
    {
        $isNotEmptyString = new IsNotEmptyString();
        self::assertEquals($expected, $isNotEmptyString($data));
    }

    /**
     * @return array<int, mixed>>
     */
    public function dataProvider(): array
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

    public function testArrayFilter(): void
    {
        $data = [1, 2.1, null, 'string', new stdClass(), [], ''];
        $expected = [3 => 'string'];

        $result = array_filter($data, new IsNotEmptyString());

        self::assertEquals($expected, $result);
    }
}
