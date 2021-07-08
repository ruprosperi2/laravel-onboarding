<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SaleOrderRepositoryInterface;

class SaleOrderGetAllController extends Controller
{
	private $repository;

    public function __invoke( SaleOrderRepositoryInterface $repository){
    	$this->repository = $repository;
    	return $this->repository->read();
    }
}