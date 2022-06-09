<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests\Json\Fixtures;

use Sharoff45\Library\Support\Json\JsonSerializeTrait;
use JsonSerializable;

/**
 * @internal
 */
class ClassWithArrayOfJsonSerializeProperty implements JsonSerializable
{
    use JsonSerializeTrait;

    /**
     * @var JsonSerializable[]
     */
    public $prop = [];

    public function __construct(JsonSerializable ...$values)
    {
        $this->prop = $values;
    }
}
