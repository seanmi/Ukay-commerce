<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use App\CartItem;

use App\Order;

use App\OrderItem;


use Auth;

use Carbon\Carbon;

use Session;

class UsersCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $this->validate($request,[
            'item' => 'required',
            'quantity' => 'required'
        ]);
        $product = Product::find(request()->item);
        if(!$product){
            Session::flash('fail', 'Item not found!');
            return redirect()->route('landing');
        }else{
            if(request()->quantity > $product->quantity){
                Session::flash('fail', 'Quantity Error!');
                return redirect()->back();
            }else{
                $p = $product->price + $product->additional_price;
                $cart_item = CartItem::where('cart_id', '=', Auth::user()->cart->id)->where('product_id', '=', request()->item)->first();
                if($cart_item){
                    if($product->discount_id){
                        $cart_item->total = $product->deduction * ($cart_item->quantity + request()->quantity);
                        $cart_item->deduction = ($p - $product->deduction)* ($cart_item->quantity + request()->quantity);
                    }else{
                        $cart_item->total = $p * ($cart_item->quantity + request()->quantity);
                        $cart_item->deduction = 0.00;
                    }
                    $cart_item->sub_total = ($cart_item->quantity + request()->quantity) * $p;
                    $cart_item->quantity = $cart_item->quantity + request()->quantity;
                    $cart_item->save();
                    $product->quantity = $product->quantity - request()->quantity;
                    $product->save();
                    if($product->quantity == 0){
                        Session::flash('success', 'Added to cart!');
                        return redirect()->route('landing');
                    }else{
                        Session::flash('success', 'Added to cart!');
                        return redirect()->back();
                    }
                }else{
                    $current_date = Carbon::now();
                    $total = 0.00;
                    $total_deduction = 0.00;
                    if($product->discount_id){
                        $total = request()->quantity * $product->deduction;
                        $total_deduction = request()->quantity * ($p - $product->deduction);
                    }else{
                        $total = request()->quantity * $p;
                    }
                    CartItem::create([
                        'cart_id' => Auth::user()->cart->id,
                        'product_id' => $product->id,
                        'quantity' => request()->quantity,
                        'expiration' => $current_date->add(2,'day')  ,
                        'total' =>  $total,
                        'sub_total' => request()->quantity * $p,
                        'deduction' => $total_deduction
                    ]);
                    $product->quantity = $product->quantity - request()->quantity;
                    $product->save();
                    if($product->quantity == 0){
                        Session::flash('success', 'Added to cart!');
                        return redirect()->route('landing');
                    }else{
                        Session::flash('success', 'Added to cart!');
                        return redirect()->back();
                    }
                }
            }
        }


        
    }


    public function addOne($id)
    {
 
        $pcs = 1;
        $product = Product::find($id);
        if(!$product){
            Session::flash('fail', 'Item not found!');
            return redirect()->route('landing');
        }else{
            if($pcs > $product->quantity){
                Session::flash('fail', 'Quantity Error!');
                return redirect()->back();
            }else{
                $p = $product->price + $product->additional_price;
                $cart_item = CartItem::where('cart_id', '=', Auth::user()->cart->id)->where('product_id', '=', $id)->first();
                if($cart_item){
                    if($product->discount_id){
                        $cart_item->total = $product->deduction * ($cart_item->quantity + $pcs);
                        $cart_item->deduction = ($p- $product->deduction)* ($cart_item->quantity + $pcs);
                    }else{
                        $cart_item->total = $product->price * ($cart_item->quantity + $pcs);
                        $cart_item->deduction = 0.00;
                    }
                    $cart_item->sub_total = ($cart_item->quantity + $pcs) * $p;
                    $cart_item->quantity = $cart_item->quantity + $pcs;
                    $cart_item->save();
                    $product->quantity = $product->quantity - $pcs;
                    $product->save();
                    if($product->quantity == 0){
                        Session::flash('success', 'Added to cart!');
                        return redirect()->route('landing');
                    }else{
                        Session::flash('success', 'Added to cart!');
                        return redirect()->back();
                    }
                }else{
                    $current_date = Carbon::now();
                    $total = 0.00;
                    $total_deduction = 0.00;
                    if($product->discount_id){
                        $total = $pcs* $product->deduction;
                        $total_deduction = $pcs * ($p - $product->deduction);
                    }else{
                        $total = $pcs * $p;
                    }
                    CartItem::create([
                        'cart_id' => Auth::user()->cart->id,
                        'product_id' => $product->id,
                        'quantity' => $pcs,
                        'expiration' => $current_date->add(2,'day')  ,
                        'total' =>  $total,
                        'sub_total' => $pcs * $p,
                        'deduction' => $total_deduction
                    ]);
                    $product->quantity = $product->quantity - $pcs;
                    $product->save();
                    if($product->quantity == 0){
                        Session::flash('success', 'Added to cart!');
                        return redirect()->route('landing');
                    }else{
                        Session::flash('success', 'Added to cart!');
                        return redirect()->back();
                    }
                }
            }
        }


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCart()
    {
        return view('user.buyer.cart')
            ->with('title', 'My Cart')
            ->with('path', '/products/cart/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $id = Auth::user()->id;
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'total' => 0.00,
            'shipping_fee' => Auth::user()->bar->shipping_fee,
            'discount' => 0.00,
            'code' => uniqid('euk')
        ]);

        $cart_id = Auth::user()->cart->id;
        $cartItems = CartItem::where('cart_id', '=', $cart_id)->get();
        $sum = 0.00;
        $discount = 0.00;
            
        foreach ($cartItems as $item) {
            
            if($item->product->deduction !== "0.00"){
                $takehome = ($item->product->deduction * 0.90) * $item->quantity;         
            }else{
                $takehome = ($item->product->price )  * $item->quantity;
            }
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'deduction' => $item->deduction,
                'takehome' => $takehome,
                'total_quantity' => $item->quantity,
                'total_price' => $item->total,
            ]);
            $sum += $item->total;
            $discount += $item->deduction;
        }   

        $order->total = $sum;
        $order->discount = $discount;
        $order->save();

        CartItem::where('cart_id', '=', $cart_id)->delete();

        Session::flash('Admin will contact you for the delivery details!');

        return redirect()->back();

    }

    /** 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOrders()
    {
        $orders = Order::where('user_id','=', Auth::user()->id)->where('status', '=', 'pending')->get();
        $delivered = Order::where('user_id','=', Auth::user()->id)->where('status', '=', 'delivered')->get();
        return view('user.seller.order.index')->with('orders', $orders)->with('delivered', $delivered);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
     
        $cart_items = CartItem::where('product_id', '=', $id)->where('cart_id', '=', Auth::user()->cart->id)->first();
        if(!$cart_items){
            Session::flash('Product not found!');
            return redirect()->back();
        }else{
            $product = Product::find($id);
            $product->quantity += $cart_items->quantity;
            $product->save();
            
            CartItem::where('product_id', '=', $id)->where('cart_id', '=', Auth::user()->cart->id)->first()->delete();
            Session::flash('Removed Successfully!');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
