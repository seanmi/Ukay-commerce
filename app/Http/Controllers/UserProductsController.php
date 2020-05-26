<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use App\Category;

use Auth;

use Session;

use File;

use Storage;

class UserProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $products = Product::orderBy('id', 'DESC')->where('seller_id', '=', Auth::user()->id)->where('status_id', '!=', 3)->get();
        return view('user.seller.dashboard')
            ->with('products', $products)
            ->with('title', 'All Items')
            ->with('categories', Category::all());
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
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'quantity' => 'required',
            'name' => 'required',
            'image' => 'required',
            'profile' => 'required',
            'price' => 'required',
            'category' => 'required',
            'size' => 'required',
            'color' => 'required',
            'details' => 'required'
        ]);

        if($request->hasfile('profile'))
        {
            $profile = request()->profile;
           $profileImageName= '';
               $p_name=time().'.1'.$profile->getClientOriginalName();
               $profile->move(public_path().'/uploads/', $p_name);  
               $profileImageName = $p_name;
        }
        
        if($request->hasfile('image'))
         {
            $filename= '';
            foreach($request->file('image') as $image)
            {
                $name=time().'.'.$image->getClientOriginalName();
                $image->move(public_path().'/uploads/', $name);  
                $filename = $filename.','.$name;
            }
         }

        $product = Product::create([
            'seller_id' => Auth::user()->id,
            'name' => request()->name,
            'quantity' => request()->quantity,
            'profile' => $profileImageName,
            'image' => $filename,
            'price' => request()->price,
            'additional_price' => request()->price * 0.10, 
            'category_id' => request()->category,
            'size' => request()->size,
            'color' => request()->color,
            'status_id' => 1,
            'details' => request()->details
        ]);

        $product->code = uniqid('euk');
        $product->save();

        Session::flash('success', 'Item Added Successfully');

        return redirect()->back();
    }

    public function updateStatus(Request $request){
        $product = Product::where('id', '=', request()->id)->first();
        $product->status_id = 2;
        $product->save();
        Session::flash('success', 'Posted Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeProduct($id)
    {
        $product = Product::find($id);
        if($product){
            if($product->status->name == 'created'){
                File::delete('uploads/'.$product->profile);
                foreach (explode(',', $product->image) as  $value) {
                    File::delete('uploads/'.$value);
                }
                Product::where('seller_id', '=', Auth::user()->id)->where('id', '=', $id)->delete();
                Session::flash('success', 'Deleted Successfully!');
                return redirect()->back();
            }else{
                Session::flash('fail', 'Unable to delete poseted item!');
                return redirect()->back();              
            }
        }else{
            Session::flash('fail', 'Item not found!');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request)
    {
        $this->validate($request,[
            'quantity' => 'required',
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'size' => 'required',
            'color' => 'required',
            'details' => 'required',
            'product_id'
        ]);

        $product = Product::find(request()->product_id);

        if($request->hasfile('profile'))
        {
          
            File::delete('uploads/'.$product->profile);
           
           $profile = request()->profile;
           $profileImageName= '';
               $p_name=time().'.1'.$profile->getClientOriginalName();
               $profile->move(public_path().'/uploads/',$p_name);  
               $profileImageName = $p_name;
               $product->profile = $profileImageName;
               
            //    Storage::delete('public/uploads/', $product->profile);
              
        }
        
        if($request->hasfile('image'))
         {
            $filename= '';
            foreach (explode(',', $product->image) as  $value) {
                if($value !== ""){
                    
                    File::delete('uploads/'.$value);
                }   
            }
            foreach($request->file('image') as $image)
            {

                $name=time().'.'.$image->getClientOriginalName();
                $image->move(public_path().'/uploads/', $name);  
                $filename = $filename.','.$name;


                $product->image = $filename;
            }
         }

         $product->name = request()->name;
         $product->quantity = request()->quantity;
         $product->price = request()->price;
         $product->category_id = request()->category;
         $product->size = request()->size;
         $product->color = request()->color;
         $product->details = request()->details;
         $product->save();

         Session::flash('success', 'Updated Successfully!');
         return redirect()->back();
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
