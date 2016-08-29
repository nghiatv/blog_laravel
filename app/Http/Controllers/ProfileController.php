<?php

namespace App\Http\Controllers;

//use Dotenv\Validator;
use Illuminate\Http\Request;
use Validator;
use File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $data = Auth::user();

        return view('admin.profile', array(
            'admin' => $data
        ));
    }

    public function updateInfo(Request $request)
    {
        $data = $request->only('name', 'role', 'birthday', 'fb_link', 'description');
        $rule = array(
            'name' => 'required|min:6|max:255|alpha_num',
            'role' => 'numeric',
            'birthday' => 'date',
            'fb_link' => 'string',

        );

        $validation = Validator::make($data, $rule);

        if ($validation->fails()) {
            return redirect('/admin/profile')->withErrors($validation);
        }

        $admin = Auth::user();

        //update info

        $admin->name = $data['name'];
        if ($admin->isAdmin()) { // only admin can change
            $admin->role = $data['role'];
        }
        $admin->birthday = $data['birthday'];
        $admin->fb_link = $data['fb_link'];
        $admin->description = $data['description'];

        $admin->save();

        return redirect('/admin/profile')->with(['success' => "Thanh cong roi nhe"]);

    }

    public function uploadImage(Request $request)
    {
//        dd($request->all());

        $validation = Validator::make($request->all(), array(
            'image_file' => 'required|image|mimes:png,jpg,jpeg,gif,bmp'
        ));

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        // neu ma thong qua duoc vaildation r y

        $image_name = $request->file('image_file')->getClientOriginalName();
        $image_extension = $request->file('image_file')->getClientOriginalExtension();

        $new_name = md5(microtime(true)) . '.' . $image_extension;
        $full_new_name = '/img/' . $new_name;
        $destinationPath = base_path() . '/public/img/';

        $request->file('image_file')->move($destinationPath, $new_name);


        //Cap nhat vao co so du lieu


        $admin = Auth::user();

        $admin->link_image = $full_new_name;
        $admin->save();


        return redirect()->back()->with(['success' => 'Thay đổi avatar thành công']);


    }


    public function updatePassword(Request $request)
    {
//        dd($request->all());
//        $input = $request->only(['last_password', 'password','password_conf']);
        $rule = array(
            'old_password' => 'required|min:6|max:255',
            'password' => 'required|min:6|confirmed',

        );

        $validation = Validator::make($request->all(), $rule);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        //Check password

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            // Neu mat khau dung thi chay vao day
            return redirect()->back()->withErrors(['old_password' => 'Mật khẩu cũ không chính xác']);
        }

        Auth::user()->password = bcrypt($request->password);
        Auth::user()->save();

        return redirect()->back()->with('success', 'Thay doi mat khau thanh cong!');

    }
}
