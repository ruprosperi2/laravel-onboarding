<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SaleOrderRepositoryInterface;

class SaleOrderPutController extends Controller
{
	private $repository;

    public function __invoke(Request $request, SaleOrderRepositoryInterface $repository, $id){
    	$this->repository = $repository;
    	$this->repository->update($request, $id);
    }
}