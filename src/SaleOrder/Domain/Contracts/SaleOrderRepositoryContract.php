<?php

namespace Src\SaleOrder\Domain\Contracts;

use Src\SaleOrder\Domain\SaleOrder;
//use Src\SaleOrder\Domain\ValueObjects\SaleOrderClient;
//use Src\SaleOrder\Domain\ValueObjects\SaleOrderPaymentTerm;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderId;

interface SaleOrderRepositoryContract
{
   // public function find(SaleOrderId $id): ?SaleOrder;

    public function save(SaleOrder $saleOrder): void;

   // public function update(SaleOrderId $saleOrderId, SaleOrder $saleOrder): void;

   // public function delete(SaleOrderId $id): void;
}