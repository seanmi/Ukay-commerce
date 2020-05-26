<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Product;

use Carbon\Carbon;

use App\Discount;

use App\Order;

use App\Report;

use App\CartItem;

use App\Wishlist;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('/admin/dashboard')->with('title', 'Admin Dashboard')->with('path', '/admin/dashboard/')
        ->with('product_count', Product::where('quantity', '!=', 0)->where('status_id', '=', 2)->count())
        ->with('order_count', Order::where('date_delivered', '=', NULL)->count())
        ->with('report_count', Report::where('active', '=', 1)->count());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function active()
    {
        $products = Product::where('status_id', '=', 2)->where('quantity', '!=', 0)->get();
        return view('admin.products.active')
            ->with('title', 'Active Items')
            ->with('path', '/admin/products/active')
            ->with('discounts', Discount::all())
            ->with('products', $products);
    }

    public function archive()
    {
        $products = Product::where('status_id', '=', 3)->get();
        return view('admin.products.archive')
            ->with('title', 'Archives')
            ->with('path', '/admin/products/archives')
            ->with('products', $products);
    }

    public function statusActive(Request $request, $id){
        $product = Product::where('id', '=', $id)->first();
        $product->status_id = 3;
        $product->received_at = date("Y-m-d");
        $product->save();

        Session::flash('success', 'Marked as Active');

        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addDiscount(Request $request, $id)
    {
        $this->validate($request, [
            'discount' => 'required'
        ]);

        $product = Product::find($id);
        if(!$product){
            Session::flash('fail', 'Product not found!');
            return redirect()->back();
        }
        $discount = Discount::find(request()->discount);
        $orig_price = $product->price + $product->additional_price;
        $deduction = $orig_price - ($orig_price* ($discount->percentage /100));
        $product->deduction = round($deduction,2);
        $product->discount_id = request()->discount;
        $product->save();

        Session::flash('success', 'Discount added successfully!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeDiscount(Request $request, $id)
    {
        $product = Product::find($id);
        if(!$product) {
            Session::flash('fail', 'Product not found!');
            return redirect()->view();
        }
        $product->discount_id = NULL;
        $product->deduction = 0.00;
        $product->save();

        Session::flash('success', 'Removed successfully!');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archiveOne($id)
    {
        $product = Product::find($id);
        if($product){
            if($product->cartItems->count() !==0){
                foreach ($product->cartItems as  $item) {
                   $product->quantity  += $item->quantity;
                   CartItem::destroy($item->id);
                }
            }
            Wishlist::where('product_id', '=', $product->id)->delete();

            $product->status_id = 3;
            $product->save();
            Session::flash('success', 'Archived!');
            return redirect()->back();     
        }else{
            Session::flash('fail', 'Product not found!');
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
