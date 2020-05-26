<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'percentage'
    ];
    

    public function product(){
       return $this->hasMany('App\Product');
    }
}
