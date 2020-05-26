<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\CartItem;

use App\Wishlist;

use App\OrderItem;

use Session;

use Hash;

use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->where('banned', '=', '0')->get();
        $banned = User::where('role', '!=', 'admin')->where('banned', '=', '1')->get();
        $admin = User::where('role', '=', 'admin')->get();
        return view('admin.users.index')
            ->with('users', $users)
            ->with('banned', $banned)
            ->with('admin', $admin)
            ->with('path', '/admin/user/')
            ->with('title', 'Users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banUser(Request $request, $id)
    {
        $user = User::find($id);
        if($user){
           foreach ($user->product as  $p) {
            Wishlist::where('product_id', '=', $p->id)->delete();
            $cartItem = CartItem::where('product_id', '=', $p->id)->get();
            $orderItem = OrderItem::where('product_id', '=', $p->id)->get();
            if($cartItem){
                foreach ($cartItem as $key => $item) {
                    $p->quantity = $p->quantity + $item->quantity; 
                    CartItem::destroy($item->id);             
                }
                $p->save();
            }
            if($orderItem){
                foreach ($cartItem as $key => $item) {
                    $p->quantity = $p->quantity + $item->quantity; 
                    CartItem::destroy($item->id);             
                }
                $p->save();
            }
            $p->status_id = 3;
            $p->save();

           } 
           $user->banned = 1;
           $user->save();

           Session::flash('success', 'Banned!');
           return redirect()->back();
        }else{
            Session::flash('fail', 'User not found!');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addAdmin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required'
        ]);

        $email = User::where('email', '=', request()->email)->count();

        if($email == 0){
            User::create([
                'name' => request()->name,
                'gender' => request()->gender,
                'email' => request()->email,
                'role' => 'admin',
                'password' => bcrypt('password'),
                'banned' => 0
            ]);    
            Session::flash('success', 'Successfully created user!');
            return redirect()->back();
        }else{
            Session::flash('fail', 'Email already in use!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
