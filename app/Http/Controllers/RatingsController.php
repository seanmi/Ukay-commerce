<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rating;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $sums =Rating::where('product_id', '=', $id)->sum('rating');
        $counts =Rating::where('product_id', '=', $id)->count();
        $total = $sums / $counts;

        return response()->json($total);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rated($id, $user_id)
    {
        $rating = Rating::where('product_id', '=', $id)->where('user_id', '=', $user_id)->first();
        if(!$rating){
            $rating = '';
        }
        return response()->json($rating);
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
            'rating' => 'required',
            'product_id' =>'required',
            'user_id' => 'required'
        ]);
        
        $rating = Rating::create([
            'rating' => request()->rating,
            'product_id' => request()->product_id,
            'user_id' => request()->user_id
        ]);

        return response()->json($rating);
        
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
