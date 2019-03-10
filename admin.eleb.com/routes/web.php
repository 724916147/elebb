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

Route::get('/statistics/order/','StatisticsController@order')->name('statistics.order');
Route::resource('ShopCategories','ShopCategoryController');
Route::resource('Shops','ShopController');
Route::resource('Admins','AdminController');
Route::resource('Users','UserController');
Route::resource('permission','PermissionController');
Route::resource('role','RoleController');
Route::resource('nav','NavController');
Route::resource('event','EventController');
Route::resource('event_prizes','EventPrizeController');
Route::resource('Activities','ActivityController');
Route::get('/Shops/up/{Shop}', 'ShopController@up')->name('Shops.up');
Route::get('/Shops/stop/{Shop}', 'ShopController@stop')->name('Shops.stop');
Route::get('login','LoginController@create')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::get('logout','LoginController@destroy')->name('logout');
Route::post('/upload','ShopCategoryController@upload')->name('upload');
Route::get('/member/list','MemberController@index')->name('member.list');
Route::get('/member/show/{member}','MemberController@show')->name('member.show');
Route::get('/member/up/{member}','MemberController@up')->name('member.up');
Route::get('/member/stop/{member}','MemberController@stop')->name('member.stop');

//Route::get('/member/list','MemberController@index')->name('member.list');
//Route::get('/users', 'UsersController@index')->name('users.index');//用户列表
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');//查看单个用户信息
//Route::get('/users/create', 'UsersController@create')->name('users.create');//显示添加表单
//Route::post('/users', 'UsersController@store')->name('users.store');//接收添加表单数据
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');//修改用户表单
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');//更新用户信息
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');//删除用户信息