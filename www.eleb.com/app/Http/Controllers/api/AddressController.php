<?php

namespace App\Http\Controllers\api;

use App\Model\Addresse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    //
    public function add(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'tel'=>'required|regex:/^1[3589]\d{9}$/',
            'provence'=>'required',
            'city'=>'required',
            'area'=>'required',
            'detail_address'=>'required',
       ],[
            'name.required'=>'请输入名称',
            'tel.required'=>'请输入电话',
            'tel.regex'=>'请输入正确的电话',
            'provence.required'=>'请输入省',
            'city.required'=>'请输入市',
            'area.required'=>'请输入县',
            'detail_address.required'=>'请输入详细地址',
       ]);
        if($validator->fails()){
            return [
                "status"=> "false",
                "message"=> implode(' ,',$validator->errors()->all()),//$validator->errors()->first('tel')
            ];
        }
        $data=[
            'user_id'=>Auth::user()->id,
            'provence'=>$request->provence,
            'city'=>$request->city,
            'area'=>$request->area,
            'detail_address'=>$request->detail_address,
            'tel'=>$request->tel,
            'name'=>$request->name,
            'is_default'=>0,
        ];
        Addresse::create($data);
        return [ "status"=> "true",
             "message"=> "添加成功"];
    }
    public function addressList(){
        $address=Addresse::where('user_id',Auth::user()->id)->get();
        return $address;
    }
    public function address(Request $request){
       $addresse= Addresse::find($request->id);
       return $addresse;
    }
    public function editAddress(Request $request){
        $addresse= Addresse::find($request->id);
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'tel'=>'required|regex:/^1[3589]\d{9}$/',
            'provence'=>'required',
            'city'=>'required',
            'area'=>'required',
            'detail_address'=>'required',
        ],[
            'name.required'=>'请输入名称',
            'tel.required'=>'请输入电话',
            'tel.regex'=>'请输入正确的电话',
            'provence.required'=>'请输入省',
            'city.required'=>'请输入市',
            'area.required'=>'请输入县',
            'detail_address.required'=>'请输入详细地址',
        ]);
        if($validator->fails()){
            return [
                "status"=> "false",
                "message"=> implode(' ,',$validator->errors()->all()),//$validator->errors()->first('tel')
            ];
        }
        $data=[
            'provence'=>$request->provence,
            'city'=>$request->city,
            'area'=>$request->area,
            'detail_address'=>$request->detail_address,
            'tel'=>$request->tel,
            'name'=>$request->name,
        ];

        $addresse->update($data);
        return [ "status"=> "true",
            "message"=> "修改成功"];
    }



}
