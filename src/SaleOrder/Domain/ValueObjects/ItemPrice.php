<?php

namespace Src\SaleOrder\Domain\ValueObjects;

final class ItemPrice
{
    private $value;

    public function __construct(float $price)
    {
        $this->value = $price;
    }

    public function value(): float
    {
        return $this->value;
    }
}