<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\MethodHelper;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class MethodHelperTest extends TestCase
{
    /**
     * @return array<int, mixed>
     */
    public function dataIsSetter(): array
    {
        return [
            ['property', false],
            ['addItem', false],
            ['setItem', true],
            ['setiTem', false],
            ['getItem', false],
            ['isItem', false],
        ];
    }

    /**
     * @dataProvider dataIsSetter
     */
    public function testIsSetter(string $name, bool $expected): void
    {
        self::assertEquals($expected, MethodHelper::isSetter($name));
    }

    /**
     * @return array<int, mixed>
     */
    public function dataIsGetter(): array
    {
        return [
            ['property', false],
            ['addItem', false],
            ['setItem', false],
            ['getiTem', false],
            ['getItem', true],
            ['isItem', false],
        ];
    }

    /**
     * @dataProvider dataIsGetter
     */
    public function testIsGetter(string $name, bool $expected): void
    {
        self::assertEquals($expected, MethodHelper::isGetter($name));
    }

    /**
     * @return array<int, mixed>
     */
    public function dataIsAdder(): array
    {
        return [
            ['property', false],
            ['addItem', true],
            ['setItem', false],
            ['addiTem', false],
            ['getItem', false],
            ['isItem', false],
        ];
    }

    /**
     * @dataProvider dataIsAdder
     */
    public function testIsAdder(string $name, bool $expected): void
    {
        self::assertEquals($expected, MethodHelper::isAdder($name));
    }

    /**
     * @return array<int, mixed>
     */
    public function dataIsLogic(): array
    {
        return [
            ['property', false],
            ['addItem', false],
            ['setItem', false],
            ['addiTem', false],
            ['getItem', false],
            ['getIsItem', true],
            ['getisItem', false],
            ['isItem', true],
            ['issItem', false],
        ];
    }

    /**
     * @dataProvider dataIsLogic
     */
    public function testIsLogic(string $name, bool $expected): void
    {
        self::assertEquals($expected, MethodHelper::IsLogic($name));
    }
}
