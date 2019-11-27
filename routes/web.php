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

Route::get('/', 'DepartmentsController@index')->middleware('auth');
Route::post('/', 'DepartmentsController@change')->middleware('auth');

Route::get('/users', 'UsersController@index')->middleware('auth');
Route::post('/users', 'UsersController@change')->middleware('auth');

Route::post('/save_user', 'UsersController@save')->middleware('auth');
Route::post('/save_department', 'DepartmentsController@save')->middleware('auth');

Route::get('/add_department', 'DepartmentsController@add')->middleware('auth');
Route::post('/add_department', 'DepartmentsController@add_department')->middleware('auth');

Route::get('/add_user', 'UsersController@add_view')->middleware('auth');

Route::post('/add', 'UsersController@add')->middleware('auth');

Auth::routes();


