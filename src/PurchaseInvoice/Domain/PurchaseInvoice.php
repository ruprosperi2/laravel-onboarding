<?php

namespace Src\PurchaseInvoice\Domain;

use Illuminate\Support\Facades\Date;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;
use Src\PurchaseInvoice\Domain\ValueObjects\Supplier;
use Src\PurchaseInvoice\Domain\ValueObjects\Payterm;
use Src\PurchaseInvoice\Domain\ValueObjects\DateCreation;
use Src\PurchaseInvoice\Domain\ValueObjects\Created;
use Src\PurchaseInvoice\Domain\ValueObjects\Status;
use Src\PurchaseInvoice\Domain\ValueObjects\Observations;
use Src\PurchaseInvoice\Domain\ValueObjects\Items;




class PurchaseInvoice
{
    private $supplier;
    private $pay_term;
    private $date;
    private $created;
    private $status;
    private $observations;
    private $items;

    public function __construct(
        Supplier     $supplier,
        Payterm      $pay_term,
        DateCreation $date,
        Created      $created,
        Status       $status,
        Observations $observations,
        Items        $items
    )
    {
        $this->supplier = $supplier;
        $this->pay_term = $pay_term;
        $this->date = $date;
        $this->created = $created;
        $this->status = $status;
        $this->observations = $observations;
        $this->items = $items;
    }

    public function supplier(): Supplier
    {
        return $this->supplier;
    }

    public function payTerm(): Payterm
    {
        return $this->pay_term;
    }

    public function date(): DateCreation
    {
        return $this->date;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function observations(): Observations
    {
        return $this->observations;
    }

    public function items(): Items
    {
        return $this->items;
    }

    public static function create(
        Supplier     $supplier,
        Payterm      $pay_term,
        DateCreation $date,
        Created      $created,
        Status       $status,
        Observations $observations,
        Items        $items
    )
    {
        return  $purchaseInvoice = new self($supplier, $pay_term, $date, $created, $status, $observations, $items);
    }
}
