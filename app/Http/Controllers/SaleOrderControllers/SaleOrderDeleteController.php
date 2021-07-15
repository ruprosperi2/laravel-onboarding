<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\SaleOrderServiceInterface;

class SaleOrderDeleteController extends Controller
{
	private $service;

    public function __invoke(Request $request, SaleOrderServiceInterface $service, $id){
    	$this->service = $service;
    	$this->service->delete($id);
    }
}