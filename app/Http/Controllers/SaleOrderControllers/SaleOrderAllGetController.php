<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleOrderResource;
use Illuminate\Http\Request;

class SaleOrderAllGetController extends Controller
{
	private $saleOrderAllGetController;

	public function __construct(\Src\SaleOrder\Infrastructure\SaleOrderAllGetController $saleOrderAllGetController)
	{
		$this->saleOrderAllGetController = $saleOrderAllGetController;
	}

	public function __invoke(Request $request)
	{
		$saleOrder = $this->saleOrderAllGetController->__invoke($request);

		return $saleOrder;
	}
}