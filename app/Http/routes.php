<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/about', function(){
    return view('about', array(
        'bg_img' => 'img/about-bg.jpg'
    ));
});


Route::get('/contact', function(){
    return view('contact',array(
       'bg_img' => 'img/contact-bg.jpg'
    ));
});

Route::get('/post',function(){
   return view('post',array(
       'bg-img' => 'img/post-bg.jpg'
   ));
});