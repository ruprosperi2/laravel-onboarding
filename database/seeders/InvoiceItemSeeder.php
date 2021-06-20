<?php

namespace Database\Seeders;

use App\Models\InvoiceItem;
use Illuminate\Database\Seeder;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoiceItem = new InvoiceItem();

        $invoiceItem->name = 'Pasta 1 kg';
        $invoiceItem->amount = 3;
        $invoiceItem->price = 2000.45;
        $invoiceItem->subtotal = $invoiceItem->amount * $invoiceItem->price;
        $invoiceItem->invoice_id = 1;

        $invoiceItem->save();
    }
}
