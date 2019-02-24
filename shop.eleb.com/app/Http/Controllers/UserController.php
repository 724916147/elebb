<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(){
        echo 1111;
    }
    public function create(){
        return view('user.add');
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
            'status'=>1,
            'shop_id'=>auth()->user()->id,
        ];
        User::create($data);
        session()->flash('success', '注册成功');
        return redirect()->route('Shops.index');
    }
    public function show(){
        return view('user.show');
    }

}
