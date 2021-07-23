<?php

namespace Src\SaleOrder\Domain\ValueObjects;

final class ItemSubTotal
{
    private $value;

    public function __construct(float $subTotal)
    {
        $this->value = $subTotal;
    }

    public function value(): float
    {
        return $this->value;
    }
}