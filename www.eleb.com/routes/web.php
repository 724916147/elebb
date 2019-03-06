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
Route::get('/api/businessList','api\ShopController@index');
Route::get('/api/businessOne','api\ShopController@One');
Route::get('/api/sms','api\MemberController@sms');
Route::post('/api/regist','api\MemberController@regist');
Route::post('/api/login','api\MemberController@login');
Route::post('/api/addAddress','api\AddressController@add');//新增收货地址
Route::post('/api/editAddress','api\AddressController@editAddress');//修改收货地址
Route::get('/api/addressList','api\AddressController@addressList');//收货地址显示
Route::get('/api/address','api\AddressController@address');//指定收货地址
Route::get('/api/cart','api\CartController@cart');//获取购物车接口
Route::post('/api/addCart','api\CartController@addCart');//保存购物车接口
Route::post('/api/addOrder','api\OrderController@addOrder');//添加订单
Route::get('/api/orderList','api\OrderController@orderList');//添加列表
Route::get('/api/order','api\OrderController@order');//指定订单
Route::post('/api/changePassword','api\MemberController@changePassword');//修改密码
Route::post('/api/forgetPassword','api\MemberController@forgetPassword');//重置密码