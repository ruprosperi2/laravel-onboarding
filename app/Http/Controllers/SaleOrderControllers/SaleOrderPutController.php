<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOrderResource;
use Illuminate\Http\Request;


class SaleOrderPutController extends Controller
{
    private $saleOrderPutController;

    public function __construct(\Src\SaleOrder\Infrastructure\SaleOrderPutController $saleOrderPutController)
    {
        $this->saleOrderPutController = $saleOrderPutController;
    }

    public function __invoke(Request $request)
    {
        $newSaleOrder = new SaleOrderResource($this->saleOrderPutController->__invoke($request));
    }
}