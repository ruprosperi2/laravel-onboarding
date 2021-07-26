<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SaleOrderDeleteController extends Controller
{
    private $saleOrderDeleteController;

    public function __construct(\Src\SaleOrder\Infrastructure\SaleOrderDeleteController $saleOrderDeleteController)
    {
        $this->saleOrderDeleteController = $saleOrderDeleteController;
    }

    public function __invoke(Request $request)
    {
        $this->saleOrderDeleteController->__invoke($request);
    }
}