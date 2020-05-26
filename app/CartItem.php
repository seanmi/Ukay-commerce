<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'expiration', 'total','deduction','sub_total'];

    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }

}
