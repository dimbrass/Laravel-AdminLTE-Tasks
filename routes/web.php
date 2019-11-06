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

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('template', function() {
    return view('template');
})->name('template')->middleware('auth');

Route::get('/roles-permissions', 'UserRoleController@index');
Route::get('/edituserroles/add', 'EditUserRolesController@add');
Route::get('/edituserroles/del', 'EditUserRolesController@del');

Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::get('/task/delete', 'TaskController@delete');
Route::get('/task/complete', 'TaskController@complete');
Route::get('/task/complete-part', 'TaskController@complete_part');
Route::get('/task/add-time', 'TaskController@add_time');
Route::get('/task/report', 'TaskController@report');





