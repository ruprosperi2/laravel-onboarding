<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\SaleOrderRepositoryInterface;

class SaleOrderGetController extends Controller
{
	private $repository;

    public function __invoke( SaleOrderRepositoryInterface $repository, $id){
    	$this->repository = $repository;
    	return $this->repository->readById($id);
    }
}