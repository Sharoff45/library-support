<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests\Json\Fixtures;

use Sharoff45\Library\Support\Json\JsonSerializeTrait;
use JsonSerializable;

/**
 * @internal
 */
class ClassWithJsonSerializeProperty implements JsonSerializable
{
    use JsonSerializeTrait;

    /**
     * @var JsonSerializable
     */
    public $prop;

    public function __construct(string $prop1, int $prop2)
    {
        $this->prop = new class($prop1, $prop2) implements JsonSerializable {
            use JsonSerializeTrait;

            /**
             * @var string
             */
            private $prop1;
            /**
             * @var int
             */
            private $prop2;

            public function __construct(string $prop1, int $prop2)
            {
                $this->prop1 = $prop1;
                $this->prop2 = $prop2;
            }
        };
    }
}
