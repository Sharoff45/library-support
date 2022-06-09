<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\Json;
use JsonException;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @internal
 */
class JsonTest extends TestCase
{
    /**
     * @dataProvider dataSuccess
     *
     * @param mixed $data
     *
     * @throws JsonException
     */
    public function testEncodeSuccess($data, string $expected): void
    {
        self::assertEquals($expected, Json::encode($data));
    }

    /**
     * @return array<int, mixed>
     */
    public function dataSuccess(): array
    {
        $object = new stdClass();
        $object->foo = 1.0;

        return [
            [1, '1'],
            [1.0, '1.0'],
            ['1.0', '"1.0"'],
            ['тест', '"тест"'],
            [true, 'true'],
            [false, 'false'],
            [null, 'null'],
            [[], '{}'],
            [[1, 1.0, 'str'], '[1,1.0,"str"]'],
            [[1, 1.0, 'тест'], '[1,1.0,"тест"]'],
            [['a' => []], '{"a":[]}'],
            [['a' => [1, 1.0, 'str']], '{"a":[1,1.0,"str"]}'],
            [['a' => ['foo' => 1, 'bar' => 1.0, 'baz' => 'str']], '{"a":{"foo":1,"bar":1.0,"baz":"str"}}'],
            [['a' => $object], '{"a":{"foo":1.0}}'],
            [$object, '{"foo":1.0}'],
        ];
    }

    /**
     * @dataProvider dataFail
     *
     * @param mixed $data
     */
    public function testEncodeFail($data): void
    {
        $this->expectException(JsonException::class);

        Json::encode($data);
    }

    /**
     * @return array<int, mixed>
     */
    public function dataFail(): array
    {
        return [
            [fopen('data://text/plain,123', 'r')],
        ];
    }

    /**
     * @dataProvider dataDecodeAsArraySuccess
     *
     * @param mixed $expected
     *
     * @throws JsonException
     */
    public function testDecodeAsArraySuccess(string $data, $expected): void
    {
        self::assertEquals($expected, Json::decodeAsArray($data));
    }

    /**
     * @return array<int, mixed>
     */
    public function dataDecodeAsArraySuccess(): array
    {
        return [
            ['1', 1],
            ['1.0', 1.0],
            ['"1.0"', '1.0'],
            ['true', true],
            ['false', false],
            ['null', null],
            ['{}', []],
            ['[1,1.0,"str"]', [1, 1.0, 'str']],
            ['{"a":[]}', ['a' => []]],
            ['{"a":[1,1.0,"str"]}', ['a' => [1, 1.0, 'str']]],
            ['{"a":{"foo":1,"bar":1.0,"baz":"str"}}', ['a' => ['foo' => 1, 'bar' => 1.0, 'baz' => 'str']]],
            ['{"a":{"foo":1.0}}', ['a' => ['foo' => 1.0]]],
            ['{"foo":1.0}', ['foo' => 1.0]],
        ];
    }

    /**
     * @dataProvider dataDecodeFailException
     *
     * @throws JsonException
     */
    public function testDecodeAsArrayException(string $data): void
    {
        $this->expectException(JsonException::class);

        Json::decodeAsArray($data);
    }

    /**
     * @return array<int, array<string>>
     */
    public function dataDecodeFailException(): array
    {
        return [
            ['{aaaa]'],
            [''],
            ['-'],
            ['{"foo":{}'],
        ];
    }

    /**
     * @dataProvider dataDecodeAsArrayFail
     *
     * @param mixed $expected
     *
     * @throws JsonException
     */
    public function testDecodeAsArrayFail(string $data, $expected): void
    {
        self::assertNotEquals($expected, Json::decodeAsArray($data));
    }

    /**
     * @return array<int, array<int, stdClass|string>>
     */
    public function dataDecodeAsArrayFail(): array
    {
        return [
            ['{"a":[]}', (object) ['a' => []]],
            ['{"a":[1,1.0,"str"]}', (object) ['a' => [1, 1.0, 'str']]],
            ['{"a":{"foo":1,"bar":1.0,"baz":"str"}}', (object) ['a' => (object) ['foo' => 1, 'bar' => 1.0, 'baz' => 'str']]],
            ['{"a":{"foo":1.0}}', (object) ['a' => (object) ['foo' => 1.0]]],
        ];
    }

    /**
     * @dataProvider dataDecodeAsObjectSuccess
     *
     * @param mixed|int|float|null $expected
     *
     * @throws JsonException
     */
    public function testDecodeAsObjectSuccess(string $data, $expected): void
    {
        self::assertEquals($expected, Json::decodeAsObject($data));
    }

    /**
     * @return array<int, float|int|string|mixed>
     */
    public function dataDecodeAsObjectSuccess(): array
    {
        return [
            ['1', 1],
            ['1.0', 1.0],
            ['"1.0"', '1.0'],
            ['true', true],
            ['false', false],
            ['null', null],
            ['{}', (object) []],
            ['[1,1.0,"str"]', [1, 1.0, 'str']],
            ['{"a":[]}', (object) ['a' => []]],
            ['{"a":[1,1.0,"str"]}', (object) ['a' => [1, 1.0, 'str']]],
            ['{"a":{"foo":1,"bar":1.0,"baz":"str"}}', (object) ['a' => (object) ['foo' => 1, 'bar' => 1.0, 'baz' => 'str']]],
        ];
    }

    /**
     * @dataProvider dataDecodeFailException
     *
     * @throws JsonException
     */
    public function testDecodeAsObjectException(string $data): void
    {
        $this->expectException(JsonException::class);

        Json::decodeAsObject($data);
    }

    /**
     * @dataProvider dataDecodeAsObjectFail
     *
     * @param mixed $expected
     *
     * @throws JsonException
     */
    public function testDecodeAsObjectFail(string $data, $expected): void
    {
        self::assertNotEquals($expected, Json::decodeAsObject($data));
    }

    /**
     * @return array<int, mixed>
     */
    public function dataDecodeAsObjectFail(): array
    {
        return [
            ['{}', []],
            ['{"a":[]}', ['a' => []]],
            ['{"a":[1,1.0,"str"]}', ['a' => [1, 1.0, 'str']]],
            ['{"a":{"foo":1,"bar":1.0,"baz":"str"}}', ['a' => ['foo' => 1, 'bar' => 1.0, 'baz' => 'str']]],
        ];
    }
}
