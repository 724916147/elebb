<?php

namespace App\Http\Controllers;

use App\Models\nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $navs=nav::all();
    }
    public function index(){
        $roles=Role::all();
        return view('role.index',compact('roles'));
    }
    public function create(){
        $permission= Permission::all();
        return view('role.add',compact('permission'));
    }
    public function store(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'per'=>'required',
        ],[
            'name.required'=>'名称不能为空',
            'per.required'=>'权限不能为空'
        ]);
        $role=Role::create([
            'name'=>$request->name,
        ]);
        $role->syncPermissions($request->per);
        return redirect()->route('role.index')->with('info','添加成功');
    }
    public function edit(Role $role){
        $permission= Permission::all();
        return view('role.edit',compact('permission','role'));
    }
    public function update(Request $request,Role $role){
        $this->validate($request,[
            'name'=>'required',
            'per'=>'required',
        ],[
            'name.required'=>'名称不能为空',
            'per.required'=>'权限不能为空'
        ]);
        $role->update([
            'name'=>$request->name,
        ]);
        $role->syncPermissions($request->per);
        return redirect()->route('role.index')->with('info','修改成功');

    }
    public static function  navs(){

        return nav::all();
    }
}
