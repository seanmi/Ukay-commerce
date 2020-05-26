<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Illuminate\Http\Response;
use Session;

class AdminMiddeleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            if($request->user()->role !== 'admin'){
                Session::flash('fail', 'Unauthorized Access');
                return new Response(view('unauthorized'));
            }
        }
        return $next($request);
    }
}
