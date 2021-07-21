<?php

namespace App\Services\InvoiceServices;

use App\Repositories\Interfaces\BaseRepositoryInterface;

class InvoicePostService
{
    private $repository;

    public function __construct(BaseRepositoryInterface $invoicePostRepository)
    {
        $this->repository = $invoicePostRepository;

    }

    public function create($body)
    {
        return $this->repository->create( $body->toArray() );
    }

}
