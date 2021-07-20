<?php

namespace App\Services\InvoiceServices;

use App\Repositories\InvoiceRepositories\InvoiceAllGetRepository;

class InvoiceAllGetService
{
    private $repository;

    public function __construct(InvoiceAllGetRepository $invoiceAllGetRepository)
    {
        $this->repository = $invoiceAllGetRepository;
    }

    public function index()
    {
        return $this->repository->index();
    }
}
