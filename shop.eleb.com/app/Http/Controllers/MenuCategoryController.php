<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    //
    public function index(){
        $menu_categories=MenuCategory::all()->where('shop_id',auth()->user()->shop_id);
        return view('menu_category.index',compact('menu_categories'));
    }
    public function create(){
        return view('menu_category.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'captcha' => 'required|captcha',
            'name' => 'required',
            'type_accumulation' => 'required',
            'description' => 'required',
        ],[
            'captcha.required'=>'请输入验证码',
            'captcha.captcha'=>'请输入正确得验证码',
            'name.required'=>'请输入分类名称',
            'type_accumulation.required'=>'请输入分类编号',
            'description.required'=>'请输入描述信息',
        ]);
        $data=[
            'name'=>$request->name,
            'type_accumulation'=>$request->type_accumulation,
            'shop_id'=>auth()->user()->shop_id,
            'description'=>$request->description,
            'is_selected'=>0,
        ];
        MenuCategory::create($data);
        session()->flash('success', '添加成功');
        return redirect()->route('MenuCategories.index');
    }
    public function edit(MenuCategory $MenuCategory){
        return view('menu_category.edit',compact('MenuCategory'));
    }
    public function update(Request $request,MenuCategory $MenuCategory){
        $this->validate($request,[
            'captcha' => 'required|captcha',
            'name' => 'required',
            'type_accumulation' => 'required',
            'description' => 'required',
        ],[
            'captcha.required'=>'请输入验证码',
            'captcha.captcha'=>'请输入正确得验证码',
            'name.required'=>'请输入分类名称',
            'type_accumulation.required'=>'请输入分类编号',
            'description.required'=>'请输入描述信息',
        ]);
        $data=[
            'name'=>$request->name,
            'type_accumulation'=>$request->type_accumulation,
            'shop_id'=>auth()->user()->shop_id,
            'description'=>$request->description,
            'is_selected'=>0,
            ];
        $MenuCategory->update($data);
        session()->flash('warning', '修改成功');
        return redirect()->route('MenuCategories.index');
    }

    public function destroy(MenuCategory $MenuCategory){
        $menu=Menu::all()->where('category_id',$MenuCategory->id)->first();
        if($menu){

        session()->flash('warning', '该分类下有菜品不允许删除');
        }else{
            $MenuCategory->delete();
            session()->flash('warning', '删除成功');
        }
        return redirect()->route('MenuCategories.index');
    }
    public function default(menuCategory $menu_category){
        MenuCategory::where('is_selected',1)->where('shop_id',auth()->user()->shop_id)->update(['is_selected'=>0]);
        $menu_category->update(['is_selected'=>1]);
        session()->flash('warning', '修改成功');
        return redirect()->route('MenuCategories.index');
    }
}
