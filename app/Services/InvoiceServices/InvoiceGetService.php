<?php

namespace App\Services\InvoiceServices;

use App\Repositories\InvoiceRepositories\InvoiceGetRepository;

class InvoiceGetService
{
    private $repository;

    public function __construct(InvoiceGetRepository $invoiceGetRepository)
    {
        $this->repository = $invoiceGetRepository;
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }
}
