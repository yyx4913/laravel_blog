<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::any('sign','Admin\LoginController@test');
Route::group(['middleware' => ['web']], function () {
    

    Route::get('/','Home\IndexController@index');
    Route::get('home/cate/{cate_id}','Home\IndexController@cate');
    Route::get('home/news/{art_id}','Home\IndexController@news');


    Route::any('admin/login','Admin\LoginController@login');
    Route::get('admin/code','Admin\LoginController@code');
});

Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    Route::get('/','IndexController@index');
    Route::get('info','IndexController@info');
    Route::any('logout','LoginController@logout');
    Route::any('pass','IndexController@update_pass');


    Route::post('cate/changeOrder','CategoryController@changeOrder');
    Route::resource('category','CategoryController');
    Route::resource('article','ArticleController');
    Route::any('upload','CommonController@upload');

    Route::post('link/changeOrder','LinksController@changeOrder');
    Route::resource('links','LinksController');

    Route::post('nav/changeOrder','NavsController@changeOrder');
    Route::resource('navs','NavsController');

    Route::post('config/changeOrder','ConfigController@changeOrder');
    Route::get('config/putFile','ConfigController@putFile');
    Route::resource('config','ConfigController');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
