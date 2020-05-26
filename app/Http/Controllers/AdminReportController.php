<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;

use Session;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = Report::where('active', '=', 1)->get();
        $inactive= Report::where('active', '=', 0)->get();

        return view('admin.report.index')
        ->with('title', 'Reports Page')
        ->with('path', '/admin/report/')
        ->with('active', $active)->with('inactive', $inactive);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $report = Report::find($id);
        if($report){
            $report->active = 0;
            $report->save();
            Session::flash('success', 'Deactivated!');
            return redirect()->back();
        }else{
            Session::flash('fails', 'Report not found!');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
