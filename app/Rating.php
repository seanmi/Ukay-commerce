<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable =[
        'rating',
        'product_id',
        'user_id'
    ];
}
