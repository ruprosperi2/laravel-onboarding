<?php

namespace App\Services\InvoiceServices;

use App\Repositories\InvoiceRepositories\InvoiceDeleteRepository;

class InvoiceDeleteService
{
    private $repository;

    public function __construct(InvoiceDeleteRepository $invoiceDeleteRepository)
    {
        $this->repository = $invoiceDeleteRepository;
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
