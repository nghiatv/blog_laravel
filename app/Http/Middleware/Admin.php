<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        dd(Auth::check() && ! Auth::user()->isAdmin());

        if (Auth::guard('web')->guest()) {
            return redirect()->guest('admin/login');

        } else if (Auth::check() && ( !Auth::user()->isAdmin() && ! Auth::user()->isAuthor())) {
            Auth::logout();
            return redirect()->guest('admin/login')->withErrors(['permission' => 'YOu dont have permission']);
        }

        return $next($request);


    }
}
