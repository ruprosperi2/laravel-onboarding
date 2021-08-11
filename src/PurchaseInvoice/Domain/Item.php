<?php

namespace Src\PurchaseInvoice\Domain;

use Src\PurchaseInvoice\Domain\ValueObjects\Amount;
use Src\PurchaseInvoice\Domain\ValueObjects\Name;
use Src\PurchaseInvoice\Domain\ValueObjects\Price;

class Item
{
    private $name;
    private $amount;
    private $price;

    public function __construct(
        Name   $name,
        Amount $amount,
        Price  $price
    )
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->price = $price;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function amount(): Amount
    {
        return $this->amount;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public static function create(
        Name   $name,
        Amount $amount,
        Price  $price
    ){
        return $item = new self($name, $amount, $price);
    }
}
