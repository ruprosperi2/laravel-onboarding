<?php

namespace Src\PurchaseInvoice\Domain\Contract;

interface PurchaseInvoiceRepository
{
    public function findAll(): object;
}
