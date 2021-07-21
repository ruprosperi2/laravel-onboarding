<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceRepository implements BaseRepositoryInterface
{
    private $invoice;
    private $invoiceItem;
    private $invoiceGet;

    public function __construct(Invoice $invoice, InvoiceItem $invoiceItem)
    {
        $this->invoice = $invoice;
        $this->invoiceItem = $invoiceItem;
    }

    public function create(array $data)
    {
        $this->invoice->create( $data->all() );

        $invoiceItems = [];

        foreach ($data->items as $item) {
            $invoiceItems[] = new InvoiceItem($item);
        }

        $this->invoice->invoiceItems()->saveMany($invoiceItems);

        return http_response_code();
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
