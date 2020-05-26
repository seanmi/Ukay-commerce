<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Discount;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discounts.index')
            ->with('discounts', $discounts)
            ->with('path','/admin/discount/')
            ->with('title', 'Discounts');
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
            'name' => 'required',
            'percentage' => 'required',

        ]);

        Discount::create([
            'name' => request()->name,
            'percentage' => request()->percentage,
        ]);

        Session::flash('success', 'Added Successfully!');

        return redirect()->back();
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
     
       $this->validate($request, [
           'name' => 'required',
           'percentage' => 'required'
       ]);

       $discount = Discount::find($id);

       if($discount){
            $discount->name = request()->name;
            $discount->percentage = request()->percentage;
            $discount->save();
            Session::flash('success', 'Updated Successfully!');
            return redirect()->back();
       }else{
           Session::flash('fail', 'Discount not found!');
           return redirect()->back();
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $discount = Discount::find($id);
        if($discount){
            Discount::destroy($id);
            Session::flash('success', 'Deleted Successfully!');
            return redirect()->back();
        }else{
            Session::flash('fail', 'Discount not found!');
            return redirect()->back();  
        }
    }
}
