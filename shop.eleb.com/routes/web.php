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
    return view('welcome');

});
Route::resource('Shops','ShopController');
Route::resource('Users','UserController');
Route::resource('MenuCategories','MenuCategoryController');
Route::resource('Menus','MenuController');
Route::resource('Activities','ActivityController');
Route::resource('Activities','ActivityController');
Route::get('/password/edit','UserController@edit')->name('password.edit');
Route::get('/MenuCategories/default/{menu_category}','MenuCategoryController@default')->name('MenuCategories.default');
Route::post('/password/update','UserController@update')->name('password.update');
Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::get('/order/list','OrderController@orderList')->name('order.list');
Route::get('/order/list','OrderController@orderList')->name('order.list');
Route::get('/order/show/{order}','OrderController@show')->name('order.show');
Route::get('/order/cancel/{order}','OrderController@cancel')->name('order.cancel');
Route::get('/order/count','OrderController@count')->name('order.count');
Route::get('/order/goods','OrderController@goods')->name('order.goods');
//Route::get('/users', 'UsersController@index')->name('users.index');//用户列表
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');//查看单个用户信息
//Route::get('/users/create', 'UsersController@create')->name('users.create');//显示添加表单
//Route::post('/users', 'UsersController@store')->name('users.store');//接收添加表单数据
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');//修改用户表单
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');//更新用户信息
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');//删除用户信息