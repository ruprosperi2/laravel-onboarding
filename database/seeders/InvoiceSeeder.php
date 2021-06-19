<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoice = new Invoice;

        $invoice->supplier = 'Empresas Polar';
        $invoice->pay_term = 'Pagar antes de que finalice el mes';
        $invoice->date = '2021-06-12';
        $invoice->created = 'Ruben';
        $invoice->status = 'C';
        $invoice->observations = 'Sin novedad';

        $invoice->save();
    }
}
