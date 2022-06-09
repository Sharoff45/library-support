<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests;

use Sharoff45\Library\Support\Factory;
use Sharoff45\Library\Support\Tests\Factory\Fixtures\TestClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

/**
 * @internal
 */
class FactoryTest extends TestCase
{
    /**
     * @var Factory
     */
    private $factory;

    protected function setUp(): void
    {
        $this->factory = new Factory();
    }

    public function testCreate(): void
    {
        $data = ['prop1' => 1, 'prop2' => 'test', 'prop3' => [1, 2, 3]];

        /** @var TestClass $result */
        $result = $this->factory->create(TestClass::class, $data);

        self::assertEquals(1, $result->getProp1());
        self::assertEquals('test', $result->getProp2());
        self::assertEquals([1, 2, 3], $result->getProp3());
    }

    public function testCreateWithUndefinedProperty(): void
    {
        $data = ['prop0' => 1];

        /** @var TestClass $result */
        $result = $this->factory->create(TestClass::class, $data);

        self::assertEquals(null, $result->getProp1());
        self::assertEquals(null, $result->getProp2());
        self::assertEquals(null, $result->getProp3());
    }

    public function testCreateIncorrectData(): void
    {
        $data = ['prop1' => 'test'];

        self::expectException(InvalidArgumentException::class);

        $this->factory->create(TestClass::class, $data);
    }
}
