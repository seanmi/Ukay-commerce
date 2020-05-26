<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;

use Carbon\Carbon;

use Session;

use Auth;

use App\OrderItem;

use App\Product;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.order.index')
        ->with('orders', Order::orderBy('created_at', 'DESC')->where('date_delivered', '=', NULL)->get())
        ->with('ordered', Order::orderBy('created_at', 'DESC')->where('date_delivered', '!=', NULL)->get())
        ->with('title', 'Orders')
        ->with('path', '/admin/order/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivered($id)
    {
        $order = Order::find($id);
        if($order){
            $order->date_delivered = Carbon::now();
            $order->status = "delivered";
            $order->save();
            Session::flash('success', 'Updated Order Successfully!');
            return redirect()->back();
        }else{
            Session::flash('fail', 'Order not found');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder($id)
    {
        $order = Order::find($id);
        if($order){
            $order_items = OrderItem::where('order_id', '=', $id)->get();
            foreach ($order_items as  $item) {
                $product = Product::find($item->product_id);
                $product->quantity = $product->quantity + $item->total_quantity;
                $product->save();
                OrderItem::destroy($item->id);
            }
            Order::destroy($order->id);
            Session::flash('success', 'Cancelled!');
            return redirect()->back();
        }else{
            Session::flash('fail', 'Order not found!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
