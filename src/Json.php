<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support;

use JsonException;

final class Json
{
    /**
     * @param mixed $data
     *
     * @throws JsonException
     */
    public static function encode($data): string
    {
        if (isNotEmptyArray($data)) {
            return json_encode(
                $data,
                JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION
            );
        }

        return json_encode(
            $data,
            JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION | JSON_FORCE_OBJECT
        );
    }

    /**
     * @throws JsonException
     *
     * @return mixed
     */
    public static function decodeAsArray(string $content)
    {
        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws JsonException
     *
     * @return mixed
     */
    public static function decodeAsObject(string $content)
    {
        return json_decode($content, false, 512, JSON_THROW_ON_ERROR);
    }
}
