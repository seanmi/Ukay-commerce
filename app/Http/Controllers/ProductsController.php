<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Product;

use App\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('category')){
            $products = Product::where('status_id', '!=', 3)->where('status_id', '!=' ,1)->where('quantity', '!=', 0)->where('category_id', '=', request()->category)->get();
        }else{
            $products = Product::where('status_id', '!=', 3)->where('status_id', '!=' ,1)->where('quantity', '!=', 0)->get();
        }

        return view('user.buyer.index')
            ->with('products', $products)
            ->with('title', 'Items')
            ->with('path', '/products')
            ->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        return view('user.buyer.cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $product = Product::find($id);
        if(!$product ){
            Session::flash('fail', 'Product not found!');
            return redirect()->back();
        }
        
        return view('user.buyer.view')
            ->with('product', $product)
            ->with('path', '/product/view/')
            ->with('title', $product->name);
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
