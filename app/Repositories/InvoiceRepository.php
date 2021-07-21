<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements BaseRepositoryInterface
{
    private $invoice;
    private $invoiceItem;
    private $invoiceGet;
    private $invoiceNew;
    private $result = false;

    public function __construct(Invoice $invoice, InvoiceItem $invoiceItem)
    {
        $this->invoice = $invoice;
        $this->invoiceItem = $invoiceItem;
    }

    public function create(array $data)
    {
       DB::transaction(function () use ($data) {

           $this->invoiceNew = $this->invoice->create($data);

            $invoiceItems = [];

            foreach ($data['items'] as $item) {
                $invoiceItems[] = new InvoiceItem($item);
            }

            $this->invoiceNew->invoiceItems()->saveMany($invoiceItems);

            $this->result = true;

        });

       return $this->result;
    }

    public function read()
    {
        return $this->invoice->all()->toJson();
    }

    public function update(array $data, $id)
    {
        return "update";
    }

    public function delete($id)
    {
        return "delete";
    }

    public function readById($id)
    {
        $this->invoiceGet = $this->invoice->find($id);

        if ($this->invoiceGet != null) {

            $this->invoiceGet->invoiceItems;

            return $this->invoiceGet->toJson();

        }
    }
}
