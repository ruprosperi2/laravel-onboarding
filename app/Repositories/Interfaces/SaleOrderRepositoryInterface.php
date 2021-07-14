<?php

namespace App\Repositories\Interfaces;

interface SaleOrderRepositoryInterface extends BaseRepositoryInterface
{
    public function createItem($id, array $item);

    public function updateItem(array $item);
}