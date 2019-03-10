<?php

namespace App\Http\Controllers;

use App\Models\nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $navs=nav::all();
    }

    //
    public function index()
    {
        $permission = Permission::all();
        return view('permission.index', compact('permission'));
    }

    public function create()
    {
        $app = app();
        $routes = $app->routes->getRoutes();
        foreach ($routes as $k => $value) {
            $path[] = $value->uri;
        }
        return view('permission.add', compact('path'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url'=> 'required'
        ], [
            'name.required' => '名称不能为空',
            'url.required' => '路由不能为空',
        ]);
        if(!Permission::where('name',$request->url)->first()){
            Permission::create([
                'name' => $request->name,
            ]);
            return redirect()->route('permission.index')->with('info', '添加成功');
        }
        return redirect()->route('permission.create')->with('info', '路由被占用');



        return redirect()->route('permission.index')->with('info', '添加成功');
    }

    public function edit(Permission $permission)
    {

        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => '名称不能为空',
        ]);
        $permission->update([
            'name' => $request->name,
        ]);
        return redirect()->route('permission.index')->with('info', '修改成功');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('danger', '删除成功');
        return redirect()->route('permission.index');
    }
}
