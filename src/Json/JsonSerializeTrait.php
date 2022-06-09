<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Json;

trait JsonSerializeTrait
{
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return JsonSerializeHelper::jsonSerializeRecursive(get_object_vars($this));
    }
}
