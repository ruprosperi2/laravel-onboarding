<?php

namespace App\Repositories\InvoiceRepositories;

use App\Models\Invoice;




class InvoiceAllGetRepository
{

    public function index()
    {
        return Invoice::all()->toJson();
    }
}
