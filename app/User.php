<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Order;
use App\OrderItem;
use Auth;
use App\Product;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','birth_date', 'gender', 'address', 'contact_no', 'role', 'cart_id', 'house_number', 'barangay','banned'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart(){
        return $this->hasOne('App\Cart');
    }

    public function bar(){
        return $this->belongsTo('App\Barangay', 'barangay');
    }

    public function product(){
        return $this->hasMany('App\Product', 'seller_id');
    }

    public function checkNotif(){
        $arr = [];
        $s = "";
        $products = Product::where('seller_id', '=', Auth::user()->id)->get();
        if($products){
            foreach ($products as $product) {
                array_push($arr, $product->id);
            }
            $orderItems = OrderItem::whereIn('product_id',$arr)->get();
        
            if($orderItems){
                foreach ($orderItems as $key => $orderItem) {
                    $order = Order::find($orderItem->order_id);
                    if(!is_null($order->date_delivered)){
                        continue;
                    }else{
                        return 1;
                    }
                    
                }
            }
        }   
        return 0;
    }
}
