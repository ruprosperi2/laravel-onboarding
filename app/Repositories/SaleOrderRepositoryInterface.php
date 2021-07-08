<?php

namespace App\Repositories;

interface SaleOrderRepositoryInterface
{
    public function create(array $data);

    public function read();

    public function update(array $data, $id);

    public function delete($id);
}