<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOrderResource;
use Illuminate\Http\Request;

class SaleOrderGetController extends Controller
{
	private $saleOrderGetController;

	public function __construct(\Src\SaleOrder\Infrastructure\SaleOrderGetController $saleOrderGetController)
	{
		$this->saleOrderGetController = $saleOrderGetController;
	}

	public function __invoke(Request $request)
	{
		$saleOrder = new SaleOrderResource($this->saleOrderGetController->__invoke($request));

		return response($saleOrder, 200);
	}
}