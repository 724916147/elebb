<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\nav;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        $navs=nav::all();
        $this->middleware('auth',['except'=>['create','store']]);
    }
    //
    public function index(Request $request){
        if($request->time==1){
            $activities=Activity::all()->where('start_time','>',date('Y-m-d h:i:s'));
        }elseif($request->time==2){
            $activities=Activity::all()->where('start_time','<',date('Y-m-d h:i:s'))->where('end_time','>',date('Y-m-d h:i:s'));
        }elseif($request->time==3) {
            $activities=Activity::all()->where('end_time','<',date('Y-m-d h:i:s'));
        }else{
            $activities=Activity::all();
        }

        return view('activity.index',compact('activities'));
    }

    public function create(){
        return view('activity.add');
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ],[
            'title.required'=>'名称不能为空',
            'content.required'=>'内容不能为空',
            'start_time.required'=>'选择活动开始时间',
            'end_time.required'=>'选择活动结束时间',
        ]);

        $data=[
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ];
        Activity::create($data);
        return redirect()->route('Activities.index')->with('info', '添加成功');
    }
    public function show(Activity $Activity){
        return view('activity.show',compact('Activity'));
    }
    public function edit(Activity $Activity){
        return view('activity.edit',compact('Activity'));
    }
    public function update(Request $request,Activity $Activity){
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ],[
            'title.required'=>'名称不能为空',
            'content.required'=>'内容不能为空',
            'start_time.required'=>'选择活动开始时间',
            'end_time.required'=>'选择活动结束时间',
        ]);
        $data=[
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ];
        $Activity->update($data);
        return redirect()->route('Activities.index')->with('info', '修改成功');
    }
    public function destroy(Activity $Activity)
    {
        $Activity->delete();
        session()->flash('danger', '删除成功');
        return redirect()->route('Activities.index');
    }

}
