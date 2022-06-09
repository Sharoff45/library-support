<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support\Util;

use Ramsey\Uuid\Uuid;

class UuidGenerator
{
    public static function getUuid(string $idOrUuid): string
    {
        if (false === Uuid::isValid($idOrUuid)) {
            return self::generateUuidById($idOrUuid);
        }

        return $idOrUuid;
    }

    public static function generateUuid(): string
    {
        return Uuid::uuid4()->toString();
    }

    public static function generateUuidById(string $id): string
    {
        return Uuid::uuid3(Uuid::NIL, $id)->toString();
    }
}
