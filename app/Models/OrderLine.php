<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function items(){

        return$this->belongsTo(Items::class);

    }

    public function oders(){

        return$this->belongsTo(Oders::class);

    }

}
