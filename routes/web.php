<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('home');
});

Route::get('/profile/photo/{filename}', 'FileController@getProfilePhoto')->middleware('auth');
Route::get('/list_to_do/file/{filename}', 'FileController@getListToDoFile')->middleware('auth');
Route::get('/activity/file/{filename}', 'FileController@getActivityFile')->middleware('auth');
Route::get('/comment/file/{filename}', 'FileController@getCommentFile')->middleware('auth');
Route::get('/M_A_R_I_T_I_M/create', 'UserController@add');

require_once "menu_routes.php";
require_once "data_routes.php";
