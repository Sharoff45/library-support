<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support;

final class IsNotEmptyArray
{
    /**
     * @param mixed $value
     */
    public function __invoke($value): bool
    {
        return true === is_array($value) && [] !== $value;
    }
}
