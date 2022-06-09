<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests\Json;

use Sharoff45\Library\Support\Tests\Json\Fixtures\ClassWithArrayOfJsonSerializeProperty;
use Sharoff45\Library\Support\Tests\Json\Fixtures\ClassWithArrayProperty;
use Sharoff45\Library\Support\Tests\Json\Fixtures\ClassWithBoolProperties;
use Sharoff45\Library\Support\Tests\Json\Fixtures\ClassWithJsonSerializeProperty;
use Sharoff45\Library\Support\Tests\Json\Fixtures\EmptyClass;
use InvalidArgumentException;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class JsonSerializeTraitTest extends TestCase
{
    /**
     * @dataProvider dataJsonSerialize
     *
     * @param mixed                $raw
     * @param array<string, mixed> $serialized
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testJsonSerialize($raw, array $serialized): void
    {
        // Act
        $properties = $raw->jsonSerialize();

        // Assert
        self::assertEquals($serialized, $properties);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function dataJsonSerialize(): array
    {
        return [
            [
                'raw' => new ClassWithArrayOfJsonSerializeProperty(new ClassWithJsonSerializeProperty('value1', 123)),
                'serialized' => [
                    'prop' => [
                        [
                            'prop' => ['prop1' => 'value1', 'prop2' => 123],
                        ],
                    ],
                ],
            ],
            [
                'raw' => new ClassWithJsonSerializeProperty('value1', 123),
                'serialized' => ['prop' => ['prop1' => 'value1', 'prop2' => 123]],
            ],
            [
                'raw' => new ClassWithBoolProperties(true, false, true),
                'serialized' => ['prop' => true, 'prop1' => false, 'prop2' => true],
            ],
            [
                'raw' => new ClassWithArrayProperty(['value1', 'value2', 'value3']),
                'serialized' => ['prop' => ['value1', 'value2', 'value3']],
            ],
            [
                'raw' => new EmptyClass(),
                'serialized' => [],
            ],
        ];
    }
}
