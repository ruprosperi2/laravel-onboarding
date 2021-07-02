<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $table = "order_items";

    protected $fillable = [

        'product_name',
        'amount',
        'price',
        'subtotal',
    ];

    public function orderTable()
    {
        return $this->belongsTo(PurchaseOrder::class);

    protected $fillable = ['name', 'amount', 'price', 'sub_total'];

    public function sale_orders(){
    	return $this->belongsTo(SaleOrder::class);

    }
}
