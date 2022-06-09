<?php

declare(strict_types=1);

namespace Sharoff45\Library\Support;

use Symfony\Component\PropertyAccess\Exception\AccessException;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;
use Symfony\Component\PropertyAccess\Exception\UnexpectedTypeException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class Factory
{
    /**
     * @var PropertyAccessor
     */
    private $propertyAccessor;

    public function __construct()
    {
        $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * @param array<string, mixed> $data
     *
     * @throws AccessException
     * @throws InvalidArgumentException
     * @throws UnexpectedTypeException
     */
    public function create(string $class, array $data): object
    {
        $dto = new $class();

        $this->fillFields($dto, $data);

        return $dto;
    }

    /**
     * @param array<string, mixed> $data
     *
     * @throws AccessException
     * @throws InvalidArgumentException
     * @throws UnexpectedTypeException
     */
    private function fillFields(object $object, array $data): void
    {
        foreach ($data as $field => $value) {
            if ($this->propertyAccessor->isWritable($object, $field)) {
                $this->propertyAccessor->setValue($object, $field, $value);
            }
        }
    }
}
