<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    //
    public function index(){
        $ShopCategories=ShopCategory::all();
        return view('shop_category.index',compact('ShopCategories'));
    }
    public function create(){
        return view('shop_category.add');
    }
    public function store(Request $request){
        //表单验证
        $this->validate($request, [
            'name' => 'required',
            'img' => 'required|image',
            'status' => 'required',
        ],[
            'name.required'=>'名称不能为空',
            'img.required'=>'请选择图片',
            'img.image'=>'请选择正确得图片',
        ]);
        $file = $request->file('img');
        $path=Storage::url($file->store('public/shop_category'));
        $data=[
            'name'=>$request->name,
            'img'=>$path,
            'status'=>$request->status,
        ];
        ShopCategory::create($data);
        session()->flash('success','分类添加成功');
        return redirect()->route('ShopCategories.index');
    }
    public function edit(ShopCategory $ShopCategory){
        return view('shop_category.edit',compact('ShopCategory'));
    }
    public function update(Request $request,ShopCategory $ShopCategory){
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required'=>'名称不能为空',
        ]);

        $image = $request->file('img');

        if($image){
            $img=Storage::url($image->store('public/shop_category'));
        }else{
            $img=$ShopCategory->img;
        }
        $ShopCategory->update([
            'name'=>$request->name,
            'img'=>$img,
            'status'=>$request->status,
        ]);
        session()->flash('warning','分类修改成功');
        return redirect()->route('ShopCategories.index');
    }
    public function destroy(ShopCategory $ShopCategory){
        $ShopCategory->delete();
        session()->flash('danger','商品删除成功');
        return redirect()->route('ShopCategories.index');
    }
}
