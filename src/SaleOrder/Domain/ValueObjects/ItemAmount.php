<?php

namespace Src\SaleOrder\Domain\ValueObjects;

final class ItemAmount
{
    private $value;

    public function __construct(int $amount)
    {
        $this->value = $amount;
    }

    public function value(): int
    {
        return $this->value;
    }
}