<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index(Request $request){

        $Menus=Menu::where(function ($query){
            $query->where('shop_id',auth()->user()->shop_id);
        } )->where(function ($query) use($request){
            if($request->category_id){
                $query->where('category_id',$request->category_id);
            }
        })->where(function ($query) use($request){
            if($request->good_name){
                $query->where('goods_name','like',"%$request->good_name%");
            }
        })->where(function ($query) use($request){
            if($request->low) {
                $query->where('goods_price', '>', $request->low);
            }
        })->where(function ($query) use($request){
            if($request->high) {
                $query->where('goods_price', '<', $request->high);
            }
        })->get();

       //'shop_id',auth()->user()->shop_id

        $menu_categories=MenuCategory::all()->where('shop_id',auth()->user()->shop_id);
        return view('menu.index',compact('Menus','menu_categories'));
    }
    public function create(){
        $menu_categories=MenuCategory::all()->where('shop_id',auth()->user()->shop_id);
        return view('menu.add',compact('menu_categories'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'captcha' => 'required|captcha',
            'goods_name' => 'required',
            'rating' => 'required',
            'category_id' => 'required',
            'goods_price' => 'required',
            'description' => 'required',
            'tips' => 'required',
            'goods_img' => 'required|image',
            'status' => 'required',
        ],[
            'captcha.required'=>'请输入验证码',
            'captcha.captcha'=>'请输入正确得验证码',
            'goods_name.required'=>'请输入分类名称',
            'rating.required'=>'请输入评分',
            'category_id.required'=>'请选择分类',
            'goods_price.required'=>'请输入价格',
            'description.required'=>'请输入描述',
            'tips.required'=>'请输入提示信息',
            'goods_img.required'=>'请上传图片',
            'goods_img.image'=>'请上传正确图片',
            'status.required'=>'请选择商品状态',
        ]);
        $img=$request->file('goods_img');
        $data=[
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'shop_id'=>auth()->user()->shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>0,
            'rating_count'=>0,
            'tips'=>$request->tips,
            'goods_img'=>url(Storage::url($img->store('public/menu'))),
            'status'=>$request->status,
            'satisfy_count'=>0,
            'satisfy_rate'=>0,
        ];
        Menu::create($data);
        return redirect()->route('Menus.index')->with('info', '添加成功');
    }
    public function show(Menu $Menu){
        return view('menu.show',compact('Menu'));
    }
    public function edit(Menu $Menu){
        $menu_categories=MenuCategory::all()->where('shop_id',auth()->user()->shop_id);
    return view('menu.edit',compact('Menu','menu_categories'));
    }
    public function update(Request $request,Menu $Menu){
        $this->validate($request,[
            'captcha' => 'required|captcha',
            'goods_name' => 'required',
            'rating' => 'required',
            'category_id' => 'required',
            'goods_price' => 'required',
            'description' => 'required',
            'tips' => 'required',
            'status' => 'required',
        ],[
            'captcha.required'=>'请输入验证码',
            'captcha.captcha'=>'请输入正确得验证码',
            'goods_name.required'=>'请输入分类名称',
            'rating.required'=>'请输入评分',
            'category_id.required'=>'请选择分类',
            'goods_price.required'=>'请输入价格',
            'description.required'=>'请输入描述',
            'tips.required'=>'请输入提示信息',
            'status.required'=>'请选择商品状态',
        ]);
        $img=$request->file('goods_img');
        if($img){
            $path=url(Storage::url($img->store('public/menu')));
        }else{
            $path=$Menu->goods_img;
        }
        $data=[
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'shop_id'=>auth()->user()->shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>$Menu->month_sales,
            'rating_count'=>$Menu->rating_count,
            'tips'=>$request->tips,
            'goods_img'=>$path,
            'status'=>$request->status,
            'satisfy_count'=>$Menu->satisfy_count,
            'satisfy_rate'=>$Menu->satisfy_rate,
        ];
        $Menu->update($data);
        return redirect()->route('Menus.index')->with('warning', '修改成功');
    }
    public function destroy(Menu $Menu){
        $Menu->delete();
        return redirect()->route('Menus.index')->with('warning', '删除成功');
    }
}
