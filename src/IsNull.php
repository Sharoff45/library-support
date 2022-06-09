<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support;

final class IsNull
{
    /**
     * @param mixed $value
     */
    public function __invoke($value): bool
    {
        return null === $value;
    }
}
