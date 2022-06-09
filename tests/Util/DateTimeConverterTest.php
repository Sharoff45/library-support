<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests\Util;

use Sharoff45\Library\Support\Exception\DateTimeConvertException;
use Sharoff45\Library\Support\Util\DateTimeConverter;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class DateTimeConverterTest extends TestCase
{
    /**
     * @dataProvider successDataProvider
     *
     * @throws DateTimeConvertException
     */
    public function testConvertSuccess(string $value, string $expected): void
    {
        $result = DateTimeConverter::convert($value);

        self::assertEquals($expected, $result->format('c'));
    }

    /**
     * @return array[]
     */
    public function successDataProvider(): array
    {
        return [
            ['25.09.2020', '2020-09-25T00:00:00+03:00'],
            ['25.09.2020 10:52:31', '2020-09-25T10:52:31+03:00'],

            ['25-09-2020', '2020-09-25T00:00:00+03:00'],
            ['25-09-2020 10:52:31', '2020-09-25T10:52:31+03:00'],

            ['2020-09-25', '2020-09-25T00:00:00+03:00'],
            ['2020-09-25 10:52:31', '2020-09-25T10:52:31+03:00'],

            ['2020-09-25T10:52:31', '2020-09-25T10:52:31+03:00'],
            ['2020-09-25T10:52:31+03:00', '2020-09-25T10:52:31+03:00'],

            ['20200925', '2020-09-25T00:00:00+03:00'],
        ];
    }

    /**
     * @dataProvider failDataProvider
     */
    public function testConvertFail(string $value): void
    {
        self::expectException(DateTimeConvertException::class);

        DateTimeConverter::convert($value);
    }

    /**
     * @return array[]
     */
    public function failDataProvider(): array
    {
        return [
            [''],
            ['date'],
            ['datetime'],
            ['2020 09 25'],
            ['25022020'],
            ['25 09 2020 10:52:31'],
            ['2020-09-25 10-52-31'],
            ['2020-09-25 10 52 31'],

            ['2020.09.25'],
            ['2020.09.25 10:52:31'],
        ];
    }
}
