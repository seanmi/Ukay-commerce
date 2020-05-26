<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total',
        'discount',
        'date_delivered',
        'shipping_fee',
        'code'
    ];

    public function orderItems(){
        return $this->hasMany('App\OrderItem');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }


}
