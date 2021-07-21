<?php
namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;

class InvoiceRepository implements BaseRepositoryInterface
{
    public function create(array $data){
        return "create";
    }

    public function read(){
        return "read";
    }

    public function update(array $data, $id){
        return "update";
    }

    public function delete($id){
        return "delete";
    }

    public function readById($id){
        return "read by id";
    }
}
