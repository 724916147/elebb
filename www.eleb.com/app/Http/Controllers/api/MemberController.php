<?php

namespace App\Http\Controllers\api;

use App\Model\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Qcloud\Sms\SmsSingleSender;

class MemberController extends Controller
{
    //
    public function __construct()
    {

    }

    public function sms(Request $request)
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1');
        if (!$redis->get($request->tel) || $redis->ttl($request->tel) < 240) {
            $sms = mt_rand(100000, 500000);

            $redis->set($request->tel, $sms, 300);
//                 // 短信应用SDK AppID
//            $appid = 1400187984; // 1400开头
//            $appkey = "765b19698cde09bda9f3624f3f8a68bd";
//            //需要发送短信的手机号码
//            $phoneNumbers = $request->tel;
//            //短信模板ID，需要在短信应用中申请
//            $templateId = 285014;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
//
//            $smsSign = "弱噢噢私人分享"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
//            try {
//                $msender = new SmsSingleSender($appid, $appkey);
//                $params = [$sms, 5];
//
//                $msender->sendWithParam("86", $phoneNumbers, $templateId, $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
//            } catch (\Exception $e) {
//                var_dump($e);
//            }

            return ["status" => "true", "message" => "获取短信验证码成功"];
        }else{
            return ["status" => "false", "message" => "请勿重复获取验证码"];
        }
    }

    public function regist(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
            'tel' => 'required',
            'sms' => 'required',
        ],[
            'username.required'=>'账号不能为空',
            'password.required'=>'密码不能为空',
            'tel.required'=>'电话不能为空',
            'sms.required'=>'验证码不能为空',
        ]);
        $redis= new \Redis();
        $redis->connect('127.0.0.1');
        if($request->sms==$redis->get($request->tel)){
          $data=[
              'username'=>$request->username,
              'password'=>Hash::make($request->password),
              'tel'=>$request->tel,
              'remember_token'=>'',
          ];
          Member::create($data);
          return  ["status"=> "true", "message"=> "注册成功"];
        }else{
            return   ["status"=> "false", "message"=> "注册失败验证码错误"];
        }
    }
    public function login(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required',

        ],[
            'name.required'=>'账号不能为空',
            'password.required'=>'密码不能为空',
        ]);
        if(Auth::attempt([
            'username'=>$request->name,
            'password'=>$request->password,
        ],$request->has('rememberMe'))){
            return  [  "status"=>"true",
                         "message"=>"登录成功",
                            "user_id"=>Auth::user()->id,
                         "username"=>Auth::user()->username];
        }else{
            return [  "status"=>"0",
                "message"=>"登录失败",
                "user_id"=>1,
                "username"=>1];
        }
    }
    public function changePassword(Request $request){
       $mnmber= Member::find(Auth::user()->id);
      if (Hash::check($request->oldpassword,$mnmber->password)){
          $mnmber->update([
              'password'=>Hash::make($request->newpassword),
          ]);
          return ['"status": "true",
                "message": "修改成功"'];
       }
        return ['"status": "false",
                "message": "修改失败"'];
    }
    public function forgetPassword(Request $request){
        $member=Member::where('tel',$request->tel)->first();
        if ($member){
            $redis= new \Redis();
            $redis->connect('127.0.0.1');
            if ($request->sms==$redis->get($request->tel)){
                $member->update([
                    'password'=>Hash::make($request->password),
                ]);
                return [
                    "status"=> "true",
                    "message"=>"重置密码成功",
                ];
            }
            return [
                "status"=> "false",
                "message"=>"验证码错误"];
        }
        return [
            "status"=> "false",
            "message"=>"该号码不存在账号 ，请新注册"];
    }
}
