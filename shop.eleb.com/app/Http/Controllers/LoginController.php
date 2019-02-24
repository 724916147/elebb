<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function create(){
        return view('login.login');
    }
    public function store(Request $request){
        $this->validate($request,[
            'captcha' => 'required|captcha',
        ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if(Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,
        ],$request->has('rememberMe'))){//账号密码正确 ，创建会话（保存当前用户的信息到session）
            return redirect()->intended(route('Shops.index'))->with('success','登录成功');
        }else{//账号密码不正确
            return back()->with('danger','账号密码不正确');
        }
    }
    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','退出登录成功');
    }
}
