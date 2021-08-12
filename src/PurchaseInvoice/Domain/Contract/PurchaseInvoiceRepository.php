<?php

namespace Src\PurchaseInvoice\Domain\Contract;

use Src\PurchaseInvoice\Domain\PurchaseInvoice;
use Src\PurchaseInvoice\Domain\ValueObjects\Id;

interface PurchaseInvoiceRepository
{
    public function findAll(): object;

    public function find(Id $id): PurchaseInvoice;

    public function save(PurchaseInvoice $body): void;

    public function delete(Id $id): void;
}
