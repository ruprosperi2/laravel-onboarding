<?php

namespace Shared\Domain\ValueObject;

final class Items
{
    private $value;

    public function __construct(array $items)
    {
        $this->value = $items;
    }

    public function value(): array
    {
        return $this->value;
    }
}