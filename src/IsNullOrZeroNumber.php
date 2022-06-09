<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support;

final class IsNullOrZeroNumber
{
    /**
     * @param mixed $value
     */
    public function __invoke($value): bool
    {
        return null === $value || 0 === $value || 0.0 === $value;
    }
}
