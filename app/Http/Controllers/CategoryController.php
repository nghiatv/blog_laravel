<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Validator;
use App\Post;
use App\Http\Requests;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::all();

        return view('admin.list_category',array(
            'data' => $data
        ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create_category');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());


        $rules = array(
            'title' => 'required|string',
            'description' => 'required|min:20|string',
            'banner_image' => 'mimes:jpg,jpeg,png,gif,bmp'
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return redirect()->back()->withErrors($validation)->withInput();

        }

        //Neu nguoi dung thay doi hinh anh

        if ($request->file('banner_image')) {
            $image_extension = $request->file('banner_image')->getClientOriginalExtension();
            $new_name = md5(microtime(true)) . "." . $image_extension;
            $full_path = '/img/' . $new_name;
            $destination_path = base_path() . '/public/img/';
            $request->file('banner_image')->move($destination_path, $new_name);
        }


        $category = new Category;

        $category->name = $request->title;
        $category->description = $request->description;
        $category->banner_image = isset($full_path) ? $full_path : '/img/contact-bg.jpg';
        $category->status = isset($request->status) ? 1 : 0; # 1 la public 0 la nhap
        $category->save();


        return redirect('/admin/categories/' . $category->id . '/edit')->with('success', 'Tạo mới thành công nhé');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //

        $category = Category::find($id);

//        dd($category);

        return view('admin.edit_category', array(
            'data' => $category
        ));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        // Lay cac de file dang sua

        $category = Category::find($id);


//        kiem tra tinh hop le cua input

        $rules = array(
            'title' => 'required|string',
            'description' => 'required|min:20|string',
            'banner_image' => 'mimes:jpg,jpeg,png,gif,bmp'
        );

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return redirect()->back()->withErrors($validation)->withInput();

        }


        //        Xử lý các request đến
        //        Cập nhật ảnh bìa nếu thay đổi

        if ($request->file('banner_image')) {
            $image_extension = $request->file('banner_image')->getClientOriginalExtension();
            $new_name = md5(microtime(true)) . "." . $image_extension;
            $full_path = '/img/' . $new_name;
            $destination_path = base_path() . '/public/img/';
            $request->file('banner_image')->move($destination_path, $new_name);
        }

        $category->name = $request->title;
        $category->description = $request->description;
        $category->banner_image = isset($full_path) ? $full_path : '/img/contact-bg.jpg';
        $category->status = isset($request->status) ? 1 : 0; # 1 la public 0 la nhap
        $category->save();


        return redirect('/admin/categories/' . $category->id . '/edit')->with('success', 'Cập nhật thành công nhé');


//        dd($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Xóa 1 category

            Category::destroy($id);

    }
}
