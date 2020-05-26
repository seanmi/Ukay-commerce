<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'total_quantity',
        'total_price',
        'deduction',
        'takehome'
    ];

    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
