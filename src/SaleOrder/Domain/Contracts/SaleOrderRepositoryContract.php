<?php

namespace Src\SaleOrder\Domain\Contracts;

use Src\SaleOrder\Domain\SaleOrder;
use Shared\Domain\ValueObject\Id;

interface SaleOrderRepositoryContract
{
    public function save(SaleOrder $saleOrder): void;

    public function find(Id $id): ?SaleOrder;

    public function findAll(): object;

    public function update(Id $Id, SaleOrder $saleOrder): void;

    public function delete(Id $id): void;
}