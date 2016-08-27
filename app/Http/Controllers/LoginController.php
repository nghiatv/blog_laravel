<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('web')->check()){
            return redirect('/');
        }else{
            return view('auth.login');
        }

    }

    /**
     * @return string
     */
    public function check(Request $request)
    {
        $rule = array(
            'email' => 'email|required|exists:users|min:6',
            'password' => 'required|min:6'
        );

        $validation = Validator::make($request->all(), $rule);

        if ($validation->fails()) {
            return redirect('/login')->withErrors($validation)->withInput();
        }

        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
            'confirmed' => 1,
        );

        if (!Auth::guard('web')->attempt($credentials)) {
            return redirect('/login')->withErrors(['credentials' => "Có gì đó sai sai"]);
        }

//        dd(Auth::user()->role);

        return redirect('/dashboard');
    }


    public function adminIndex()
    {
//        dd(Auth::guard('admin')->check());
        if(Auth::check()){
           if(Auth::user()->isAdmin() || Auth::user()->isAuthor() ){
               return redirect('/admin');
           } else{
               return redirect('/dashboard');
           }

        }
        else{
            return view('admin.admin_login');
        }
    }

    public function adminCheck(Request $request)
    {
        $rule = array(
            'email' => 'email|required|exists:users|min:6',
            'password' => 'required|min:6'
        );

        $validation = Validator::make($request->all(), $rule);

        if ($validation->fails()) {
            return redirect('/login')->withErrors($validation)->withInput();
        }

        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
            'confirmed' => 1,
        );

        // Kiem tra thong tin dang nhap

        if(isset($request->remember)){
            $admin = Auth::attempt($credentials,true);
        }else{
            $admin = Auth::attempt($credentials);
        }

        if (!$admin) {
            return redirect('/admin/login')->withErrors(['credentials' => "Tài khoản hoặc mật khẩu không chính xác"])->withInput();
        }
        // Kiem tra quyen

//        dd(Auth::user()->isAdmin() || Auth::user()->isAuthor());

//        dd(Auth::check() && Auth::user()->isAdmin());
       return redirect('/admin');



    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function adminLogout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
