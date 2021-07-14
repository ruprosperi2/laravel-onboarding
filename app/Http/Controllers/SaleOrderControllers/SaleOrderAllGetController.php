<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SaleOrderServiceInterface;

class SaleOrderAllGetController extends Controller
{
	private $service;

    public function __invoke(SaleOrderServiceInterface $service){
    	$this->service = $service;
    	return $this->service->read();
    }
}