<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'product_id',
        'details',
        'user_id',
        'active'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id');
    }
}
