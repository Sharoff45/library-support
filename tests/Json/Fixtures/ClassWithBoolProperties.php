<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Tests\Json\Fixtures;

use Sharoff45\Library\Support\Json\JsonSerializeTrait;

/**
 * @internal
 */
class ClassWithBoolProperties
{
    use JsonSerializeTrait;

    /**
     * @var bool
     */
    public $prop1;
    /**
     * @var bool
     */
    protected $prop2;
    /**
     * @var bool
     */
    private $prop;

    public function __construct(bool $prop, bool $prop1, bool $prop2)
    {
        $this->prop = $prop;
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
    }
}
