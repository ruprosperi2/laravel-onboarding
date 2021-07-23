<?php

namespace Src\SaleOrder\Domain;

//use Src\SaleOrder\Domain\SaleOrder;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderId;
use Src\SaleOrder\Domain\ValueObjects\ItemName;
use Src\SaleOrder\Domain\ValueObjects\ItemAmount;
use Src\SaleOrder\Domain\ValueObjects\ItemPrice;
use Src\SaleOrder\Domain\ValueObjects\ItemSubTotal;

final class Item
{
    private $name;
    private $amount;
    private $price;
    private $subTotal;
    private $saleOrderId;

    public function __construct(
        ItemName $name,
        ItemAmount $amount,
        ItemPrice $price,
        ItemSubTotal $subTotal,
        SaleOrderId $saleOrderId
    )
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->price = $price;
        $this->subTotal = $subTotal;
        $this->saleOrderId = $saleOrderId;
    }

    public function name(): ItemName
    {
        return $this->name;
    }

    public function amount(): ItemAmount
    {
        return $this->amount;
    }

    public function price(): ItemPrice
    {
        return $this->price;
    }

    public function subTotal(): ItemSubTotal
    {
        return $this->subTotal;
    }

    public function saleOrderId(): SaleOrderId
    {
        return $this->saleOrderId;
    }

    public static function create(
        ItemName $name,
        ItemAmount $amount,
        ItemPrice $price,
        ItemSubTotal $subTotal,
        SaleOrderId $saleOrderId
    ): Item
    {
        $item = new self($name, $amount, $price, $subTotal, $saleOrderId);

        return $item;
    }
}