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
Route::get('/about', function () {
    return view('about', array(
        'bg_img' => 'img/about-bg.jpg'
    ));
});
Route::get('/contact', function () {
    return view('contact', array(
        'bg_img' => 'img/contact-bg.jpg'
    ));
});

Route::resource('/post', 'PostController');


//Route::get('/login', 'LoginController');
//Route::resource


//xu ly dang ki dang nhap

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@check');
Route::get('/register', 'RegisterController@index');
Route::post('/register', 'RegisterController@check');
Route::get('/logout', 'LoginController@logout');

Route::get('/register/verify/{confirmation_code}', 'RegisterController@confirm');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');


// xu ly admin route

Route::get('/admin/login', 'LoginController@adminIndex');
Route::post('/admin/login', 'LoginController@adminCheck');
Route::get('/admin/logout', 'LoginController@adminLogout');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('/profile', 'ProfileController@index');
    Route::put('/profile', 'ProfileController@updateInfo');

    Route::post('/profile/upload', 'ProfileController@uploadImage');
    Route::post('/profile/password','ProfileController@updatePassword');

    Route::resource('/users', 'UserController');
});