<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PurchaseInvoiceRepositorySeviceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Src\PurchaseInvoice\Domain\Contract\PurchaseInvoiceRepository',
            'Src\PurchaseInvoice\Infrastructure\Repository\PurchaseInvoiceMysqlRepository'

        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

