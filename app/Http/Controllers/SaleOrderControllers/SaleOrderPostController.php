<?php

namespace App\Http\Controllers\SaleOrderControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SaleOrderRepositoryInterface;

class SaleOrderPostController extends Controller
{
	private $repository;

    public function __invoke(Request $request, SaleOrderRepositoryInterface $repository){
    	$this->repository = $repository;
    	$this->repository->create($request);
    }
}