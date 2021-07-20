<?php

namespace App\Services\InvoiceServices;

use App\Repositories\InvoiceRepositories\InvoicePostRepository;

class InvoicePostService
{
    private $repository;

    public function __construct(InvoicePostRepository $invoicePostRepository)
    {
        $this->repository = $invoicePostRepository;

    }

    public function store($body)
    {
        return $this->repository->store($body);
    }

}
