<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Wishlist;

use Session;

use Auth;

use App\Product;


class WishlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.buyer.wishlist')
            ->with('wishlists', Wishlist::where('user_id', '=', Auth::user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $product = Product::find($id);

        if($product){
            if($product->seller_id !== Auth::user()->id){
                if($product !== 0){
                    Wishlist::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $product->id
                    ]);
    
                    Session::flash('fail', 'Successfully Added!');
                    return redirect()->back();  
                }else{
                    Session::flash('fail', 'Item not found!');
                    return redirect()->back();              
                }
            }else{
                Session::flash('fail', 'Error adding to wishlist!');
                return redirect()->back();                   
            }
        }else{
            Session::flash('fail', 'Item not found!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $wishlist = Wishlist::where('product_id', '=' ,$id)->where('user_id', '=', Auth::user()->id)->get();
        if($wishlist){
            Wishlist::where('product_id', '=' ,$id)->where('user_id', '=', Auth::user()->id)->delete();
            Session::flash('success', 'Removed Successfully');
            return redirect()->back();
        }else{
            Session::flash('fail','Wishlist item not found!');
            return redirect()->back();
        }
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
