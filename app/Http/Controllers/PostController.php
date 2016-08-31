<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\User;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tag = Tag::all();

        return view('admin.create_post', ['tags' => $tag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // ham them tag
    public function storeTag(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|unique:tags'
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => 'Tag có kiểu string, bắt buộc và duy nhất nhé!']);
        }

        $tag = new Tag;

        $tag->name = $request->name;
        $tag->description = "1 Tag của trang web Nghĩa Blog";
        $tag->save();
        return response()->json(['success' => 'Thêm thành công tag <strong>' . $request->name . '</strong> ']);
    }


}
