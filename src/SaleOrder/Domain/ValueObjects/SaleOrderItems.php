<?php

namespace Src\SaleOrder\Domain\ValueObjects;

final class SaleOrderItems
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