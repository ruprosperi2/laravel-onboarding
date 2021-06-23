<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oders extends Model
{
    use HasFactory;

    protected $table = "oders";

    protected $guarded = ["id"];

    protected $fillable = [

        'date',
        'created_by',
        'supplier',
        'payment_term',
        'status',
        'observations',

    ];

    public function itemOder(){

        return$this->hasMany(Items::class);

    }

}
