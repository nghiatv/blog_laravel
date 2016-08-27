<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        //Tao rule kiem tra dau vao
        $rule = array(
            'name' => 'required|unique:users|min:6|alpha_num',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:6|alpha_num'
        );
        // Kiem tra loi

        $validation = Validator::make($request->all(), $rule);

        //Neu sai thi bao loi
        if ($validation->fails()) {
            return redirect('/register')->withErrors($validation)->withInput();
        }

        //Neu dung thi tao tai khoan va doi mail xac nhan


        $confirmation_code = md5($request->name);


        // tao tai khoan


        User::create(array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'confirmation_code' => $confirmation_code,
        ));

//        Gui mail yeu cau xac nhan nguoi dung

        Mail::send('auth.emails.verify_register', ['confirmation_code' => $confirmation_code], function ($mes) use ($request) {
            $mes->from('laravel.tech11@gmail.com', "Blog App supporter");
            $mes->to($request->email, $request->name)->subject('Xác thực tài khoản tại Blog.app');
        });

        return view('auth.emails.verify_sent');

    }

    public function confirm($confirmation_code)
    {

        if (!$confirmation_code) {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::where('confirmation_code', $confirmation_code)->first();

        if (!$user) {
            throw new InvalidConfirmationCodeException;
        }


        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();


        return redirect('/login');

    }


}
