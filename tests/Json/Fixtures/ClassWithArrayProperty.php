<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests\Json\Fixtures;

use Sharoff45\Library\Support\Json\JsonSerializeTrait;

/**
 * @internal
 */
class ClassWithArrayProperty
{
    use JsonSerializeTrait;

    /**
     * @var array<int, string>
     */
    protected $prop = ['value1', 'value2', 'value3'];

    /**
     * @param string[] $prop
     */
    public function __construct(array $prop)
    {
        $this->prop = $prop;
    }
}
