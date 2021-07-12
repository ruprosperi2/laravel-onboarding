<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\SaleOrderServiceInterface;

class SaleOrderGetController extends Controller
{
	private $service;

    public function __invoke( SaleOrderServiceInterface $service, $id){
    	$this->service = $service;
    	return $this->service->readById($id);
    }
}