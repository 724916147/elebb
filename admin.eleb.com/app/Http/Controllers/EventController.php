<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index(){
        $events=Event::all();
        return view('event.index',compact('events'));
    }
    public function create(){
        return view('event.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
        ],[
            'title.required'=>'输入标题',
            'content.required'=>'输入内容',
            'signup_start.required'=>'选择开始时间',
            'signup_end.required'=>'选择结束时间',
            'prize_date.required'=>'开奖日期',
            'signup_num.required'=>'报名人数限制',
        ]);
        $data=([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0,
        ]);
        Event::create($data);
        return redirect()->route('event.index')->with('info','添加成功');
    }
    public function edit(Event $event){
        return view('event.edit',compact('event'));
    }
    public function update(Request $request,Event $event){
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
        ],[
            'title.required'=>'输入标题',
            'content.required'=>'输入内容',
            'signup_start.required'=>'选择开始时间',
            'signup_end.required'=>'选择结束时间',
            'prize_date.required'=>'开奖日期',
            'signup_num.required'=>'报名人数限制',
        ]);
        $data=([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0,
        ]);
        $event->update($data);
        return redirect()->route('event.index')->with('info','修改成功');

    }
    public function destroy(Event $event)
    {
        $event->delete();
        session()->flash('danger', '删除成功');
        return redirect()->route('event.index');
    }
}
