<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests\Factory\Fixtures;

use Sharoff45\Library\Support\Json\JsonSerializeTrait;

/**
 * @internal
 */
class TestClass
{
    /**
     * @var int|null
     */
    private $prop1;

    /**
     * @var string|null
     */
    private $prop2;

    /**
     * @var int[]|null
     */
    private $prop3;

    public function getProp1(): ?int
    {
        return $this->prop1;
    }

    public function setProp1(?int $prop1): self
    {
        $this->prop1 = $prop1;

        return $this;
    }

    public function getProp2(): ?string
    {
        return $this->prop2;
    }

    public function setProp2(?string $prop2): self
    {
        $this->prop2 = $prop2;

        return $this;
    }

    /**
     * @return int[]|null
     */
    public function getProp3(): ?array
    {
        return $this->prop3;
    }

    /**
     * @param int[]|null $prop3
     */
    public function setProp3(?array $prop3): self
    {
        $this->prop3 = $prop3;

        return $this;
    }
}
