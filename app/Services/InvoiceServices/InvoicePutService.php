<?php

namespace App\Services\InvoiceServices;

use App\Repositories\InvoiceRepositories\InvoicePutRepository;

class InvoicePutService
{
    private $repository;

    public function __construct(InvoicePutRepository $invoicePutRepository)
    {
        $this->repository = $invoicePutRepository;

    }

    public function update($body, $id)
    {
        return $this->repository->update($body, $id);
    }

}
