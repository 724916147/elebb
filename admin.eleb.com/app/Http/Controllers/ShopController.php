<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function index()
    {
        $shops = Shop::all();
        return view('shop.index', compact('shops'));
    }

    public function create()
    {
        $ShopCategories = ShopCategory::all();
        return view('shop.add', compact('ShopCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'shop_category_id' => 'required',
                'shop_name' => 'required',
                'shop_img' => 'required|image',
                'shop_rating' => 'required',
                'brand' => 'required',
                'on_time' => 'required',
                'fengniao' => 'required',
                'bao' => 'required',
                'piao' => 'required',
                'zhun' => 'required',
                'start_send' => 'required',
                'send_cost' => 'required',
                'notice' => 'required',
                'discount' => 'required',
                'status' => 'required',
            ], [
                'name.required' => '商户名称不能为空',
                'email.required' => '邮箱不能为空',
                'email.email' => '填写正确的邮箱',
                'password.required' => '密码不能为空',
                'shop_category_id.required' => '店铺分类不能为空',
                'shop_name.required' => '店铺名称不能为空',
                'shop_img.required' => '店铺图片不能为空',
                'shop_img.image' => '选择正确得图片',
                'shop_rating.required' => '评分不能为空',
                'start_send.required' => '起送金额不能为空',
                'send_cost.required' => '配送费不能为空',
                'notice.required' => '店公告不能为空',
                'discount.required' => '优惠信息不能为空',
            ]
        );
        $file = $request->file('shop_img');
        $path = url(Storage::url($file->store('public/shop')));
        $data = [
            'shop_category_id' => $request->shop_category_id,
            'shop_name' => $request->shop_name,
            'shop_img' => $path,
            'shop_rating' => $request->shop_rating,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'status' => 0,
        ];
        $shop = Shop::create($data);
        $data1 = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
            'remember_token' => '',
            'shop_id' => $shop->id,
        ];
        User::create($data1);
        session()->flash('success', '注册成功');
        return redirect()->route('Shops.index');
    }

    public function show(Shop $Shop)
    {
        return view('shop.show', compact('Shop'));
    }

    public function edit(Shop $Shop)
    {
        $ShopCategories = ShopCategory::all();
        return view('shop.edit', compact('Shop', 'ShopCategories'));
    }

    public function update(Request $request, Shop $Shop)
    {
        $this->validate($request,
            [
                'shop_category_id' => 'required',
                'shop_name' => 'required',
                'shop_rating' => 'required',
                'brand' => 'required',
                'on_time' => 'required',
                'fengniao' => 'required',
                'bao' => 'required',
                'piao' => 'required',
                'zhun' => 'required',
                'start_send' => 'required',
                'send_cost' => 'required',
                'notice' => 'required',
                'discount' => 'required',
            ], [


                'shop_category_id.required' => '店铺分类不能为空',
                'shop_name.required' => '店铺名称不能为空',
                'shop_rating.required' => '评分不能为空',
                'start_send.required' => '起送金额不能为空',
                'send_cost.required' => '配送费不能为空',
                'notice.required' => '店公告不能为空',
                'discount.required' => '优惠信息不能为空',
            ]
        );
        $file = $request->file('shop_img');
        if ($file) {
            $path = url(Storage::url($file->store('public/shop')));
        } else {
            $path = $Shop->shop_img;
        }
        $data = [
            'shop_category_id' => $request->shop_category_id,
            'shop_name' => $request->shop_name,
            'shop_img' => $path,
            'shop_rating' => $request->shop_rating,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'status' => $Shop->status,
        ];
        $Shop->update($data);
        session()->flash('warning', '修改成功');
        return redirect()->route('Shops.index');
    }

    public function destroy(Shop $Shop)
    {
        $Shop->delete();
        session()->flash('danger', '删除成功');
        return redirect()->route('Shops.index');
    }
    public function up(Shop $Shop){
       $Shop->update(['status'=>1,]);
        session()->flash('info', '启用成功');
        return redirect()->route('Shops.index');
    }
    public function stop(Shop $Shop){
        $Shop->update(['status'=>-1,]);
        session()->flash('danger', '停用成功');
        return redirect()->route('Shops.index');
    }
}
