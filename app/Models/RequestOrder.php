<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOrder extends Model
{
    use HasFactory;
    protected $table="request_orders";
    protected $fillable=['date','created_by', 'status', 'observations'];

    protected $guarded =['id'];

    public function itemsRequests(){

        return $this->belongsTo(ItemsRequest::class);
    }
}
