<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = "purchase_orders";

    protected $fillable = [

        'date',
        'created_by',
        'supplier',
        'payment_term',
        'status',
        'observations',
    ];

    public function itemsTable()
    {

        return $this->hasMany(PurchaseItem::class);
    }
}
