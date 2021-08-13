<?php

namespace Src\PurchaseInvoice\Domain\ValueObjects;

use Src\PurchaseInvoice\Domain\ValueObjects\Name;
use Src\PurchaseInvoice\Domain\ValueObjects\Amount;
use Src\PurchaseInvoice\Domain\ValueObjects\Price;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;


class Items
{
    private $value;

    public function __construct(array $items)
    {
        $this->value = $this->validate($items);

    }

    public function validate(array $items)
    {
        $rows = [];

        for ($i = 0; $i < count($items); $i++) {
            $rows[$i]['id'] =  isset($items[$i]['id']) ? new Name($items[$i]['id']) : null;
            $rows[$i]['name'] = new Name($items[$i]['name']);
            $rows[$i]['amount'] = new Amount($items[$i]['amount']);
            $rows[$i]['price'] = new Price($items[$i]['price']);
        }

        return $rows;
    }

    public function value(): array
    {
        return $this->value;
    }
}
