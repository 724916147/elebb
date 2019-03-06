<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index(Request $request){

        if($request->name){
            $members=  Member::where('username','like',"%$request->name%")->get();

        }else{
            $members=  Member::all();
        }
       return view('Member.index',compact('members'));
    }
    public function show(Member $member){
        $member=Member::find($member->id);
        return view('Member.show',compact('member'));
    }
    public function up(Member $member){
        $member=$member->update([
            'status'=>1,
        ]);
        return redirect()->route('member.list')->with('info','启用成功');
    }
    public function stop(Member $member){
        $member=$member->update([
            'status'=>0,
        ]);
        return redirect()->route('member.list')->with('info','停用成功');
    }
}
