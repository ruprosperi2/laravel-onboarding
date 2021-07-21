<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOrderResource;
use Illuminate\Http\Request;


class SaleOrderPostController extends Controller
{
	/**
     * @var \Src\SaleOrder\Infrastructure\SaleOrderPostController
     */
    private $saleOrderPostController;

    public function __construct(\Src\SaleOrder\Infrastructure\SaleOrderPostController $saleOrderPostController)
    {
        $this->saleOrderPostController = $saleOrderPostController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $newSaleOrder = new SaleOrderResource($this->saleOrderPostController->__invoke($request));
    }
}