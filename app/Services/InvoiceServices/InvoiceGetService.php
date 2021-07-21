<?php

namespace App\Services\InvoiceServices;

use App\Repositories\Interfaces\BaseRepositoryInterface;

class InvoiceGetService
{
    private $repository;

    public function __construct(BaseRepositoryInterface $invoiceGetRepository)
    {
        $this->repository = $invoiceGetRepository;
    }

    public function readById($id)
    {
        return $this->repository->readById($id);
    }
}
