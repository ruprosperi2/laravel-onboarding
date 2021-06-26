<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'amount', 'price', 'sub_total'];

    public function sale_orders(){
    	return $this->belongsTo(SaleOrder::class);
    }
}
