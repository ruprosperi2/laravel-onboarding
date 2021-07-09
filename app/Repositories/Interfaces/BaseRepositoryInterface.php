<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function create(array $data);

    public function read();

    public function update(array $data, $id);

    public function delete($id);

    public function readById($id);
}