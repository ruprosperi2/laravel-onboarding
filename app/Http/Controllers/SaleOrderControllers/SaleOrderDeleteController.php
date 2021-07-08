<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Repositories\SaleOrderRepositoryInterface;

class SaleOrderDeleteController extends Controller
{
	private $repository;

    public function __invoke(SaleOrderRepositoryInterface $repository, $id){
    	$this->repository = $repository;
    	$this->repository->delete($id);
    }
}