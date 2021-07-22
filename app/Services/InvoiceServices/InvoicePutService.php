<?php

namespace App\Services\InvoiceServices;

use App\Repositories\Interfaces\BaseRepositoryInterface;

class InvoicePutService
{
    private $repository;

    public function __construct(BaseRepositoryInterface $invoicePutRepository)
    {
        $this->repository = $invoicePutRepository;

    }

    public function update($body, $id)
    {
        return $this->repository->update($body->toArray(), $id);
    }

}
