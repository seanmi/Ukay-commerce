<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Barangay;

use Session;

class BarangaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.barangay.index')
            ->with('barangays', Barangay::all())
            ->with('path', 'admin/barangay/')
            ->with('title', 'Barangays');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'shipping' => 'required'
        ]);

        Barangay::create([
            'name' => request()->name,
            'shipping_fee' => request()->shipping
        ]);

        Session::flash('success', 'Successfully Added!');

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
        $this->validate($request,[
            'name' => 'required',
            'shipping_fee' => 'required',
        ]);
        $barangay = Barangay::find($id);
        if($barangay){
            $barangay->name = request()->name;
            $barangay->shipping_fee = request()->shipping_fee;
            $barangay->save();
            Session::flash('success', 'Updated Successfully!');
            return redirect()->back();              
        }else{
            Session::flash('fail', 'Barangay not found!');
            return redirect()->back();          
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangay = Barangay::find($id);
        if($barangay){
            if($barangay->user->count() == 0){
                Barangay::destroy($id);
                Session::flash('success', 'Deleted Successfully!');
                return redirect()->back();
            }else{
                Session::flash('fail', 'Value is currently in used by another user!');
                return redirect()->back();
            }

        }else{
            Session::flash('fail', 'Barangay not found!');
            return redirect()->back();
        }
    }
}
