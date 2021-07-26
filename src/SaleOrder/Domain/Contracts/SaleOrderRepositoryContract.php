<?php

namespace Src\SaleOrder\Domain\Contracts;

use Src\SaleOrder\Domain\SaleOrder;

interface SaleOrderRepositoryContract
{
    public function save(SaleOrder $saleOrder): void;
}