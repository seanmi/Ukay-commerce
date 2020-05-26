<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'seller_id',
        'quantity',
        'code',
        'image',
        'profile',
        'price',
        'category_id',
        'additional_price',
        'size_num',
        'size',
        'color',
        'status_id',
        'details',
        'expired_at',
        'received_at',
        'name',
    ];

    public function status(){
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'seller_id');
    }

    public function discount(){
        return $this->belongsTo('App\Discount', 'discount_id');
    }

    public function report(){
        return $this->hasMany('App\Report');
    }

    public function wishlist(){
        return $this->hasMany('App\Wishlist', 'product_id');
    }

    public function cartItems(){
        return $this->hasMany('App\CartItem', 'product_id');
    }

}
