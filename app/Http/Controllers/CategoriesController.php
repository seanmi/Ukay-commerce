<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index')
            ->with('categories', Category::all())
            ->with('title', 'Item Categories')
            ->with('path', '/admin/category/');
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
            'name' => 'required'
        ]);

        Category::create([
            'name' => request()->name
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
            'name' => 'required'
        ]);

        $category = Category::find($id);
        if($category){
            $category->name = request()->name;
            $category->save();
            Session::flash('success', 'Updated Successfully!');
            return redirect()->back();
        }else{
            Session::flash('fail', 'Category not found!');
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
        $categories = Category::find($id);
        if($categories){
            if($categories->product->count() ==0){
                Category::destroy($id);
                Session::flash('success', 'Deleted Successfully!');
                return redirect()->back();
            }else{
                Session::flash('fail', 'Value is being used by another user!');
                return redirect()->back();
            }
        }else{
            Session::flash('fail', 'Category not found!');
            return redirect()->back();
        }
    }
}
