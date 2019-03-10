<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $navs=nav::all();
        $this->middleware('auth');
    }
    //
    public function index()
    {
       // $Admin=Admin::find(1);
       // $Admin->syncRoles(['刘松','刘松222']);exit;
       //return redirect()->route('Admins.index')->with('info','修改成功');

        $admins=Admin::all();
        return view('admin.index',compact('admins'));
            }
    public function create(){
        $roles= Role::all();
        $permission= Permission::all();
        return view('admin.add',compact('permission','roles'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'email'=>'required',
            'captcha'=>'required|captcha',
        ],[
            'name.required'=>'账号不能为空',
            'password.required'=>'密码不能为空',
            'email.required'=>'邮箱不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确',
        ]);
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'remember_token'=>'',
        ];
        $admin=Admin::create($data);

            $admin->syncRoles($request->per);
        $admin->syncPermissions($request->per);


        session()->flash('success', '注册成功');
        return redirect()->route('Shops.index');
    }
    public function edit(Admin $Admin){;
            $roles = Role::all();
          $permission = Permission::all();
         return view('admin.edit', compact('Admin', 'permission', 'roles'));

    }
    public function update(Request $request,Admin $Admin){
        $Admin->syncRoles($request->role);
        $Admin->syncPermissions($request->per);
        return redirect()->route('Admins.index')->with('info','修改成功');
    }

}
