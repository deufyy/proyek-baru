<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'trx_id',
        'customer_name',
        'product_id',
        'quantity',
        'total_price',
        'payment_method',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}