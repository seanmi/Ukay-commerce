<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Session;

use Auth;

use Hash;

class UsersProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed'
        ]);
        if (Hash::check(request()->current_password, Auth::user()->password)) {
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt(request()->password);
                $user->save();
                Session::flash('success', 'Password updated successfully!');
                return redirect()->back();
        }else{
            Session::flash('fail', 'Wrong Password!');
            return redirect()->back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAddress(Request $request)
    {
        $this->validate($request, [
            'house_number' => 'required',
            'barangay' => 'required'
        ]);

        $user = User::find(Auth::user()->id);

        $user->house_number = request()->house_number;
        $user->barangay = request()->barangay;
        $user->save();

        Session::flash('success', 'Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateContact(Request $request)
    {
        $this->validate($request, [
            'contact' => 'required|min:11|max:11',
        ]);

        $user = User::find(Auth::user()->id);
        $user->contact_no = request()->contact;
        $user->save();

        Session::flash('success', 'Updated Successfully!');
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
