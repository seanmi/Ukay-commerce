<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable= [
        'name',
        'shipping_fee'
    ];

    public function user(){
        return $this->hasMany('App\User', 'barangay');
    }
}
