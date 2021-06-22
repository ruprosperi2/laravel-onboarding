<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier',
        'pay_term',
        'date',
        'created',
        'status',
        'observations'
    ];

    public function invoiceItems(){
        return  $this->hasMany(InvoiceItem::class);
    }
}
