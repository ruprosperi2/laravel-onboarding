<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;

    protected $fillable = ['client', 'payment_term', 'creation_date', 'created_by', 'state', 'observation'];

    public function items(){
    	return $this->belongsToMany(Item::class);
    }
}
 