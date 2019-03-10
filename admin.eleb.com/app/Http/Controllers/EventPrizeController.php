<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    //
    public function index(){
        $event_prizes=EventPrize::all();
        return view('event_prizes.index',compact('event_prizes'));
    }
    public function create(){
        $events=Event::all();
        return view('event_prizes.add',compact('events'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'events_id'=>'required',
            'name'=>'required',
            'description'=>'required',
        ],[
            'events_id.required'=>'选择活动',
            'name.required'=>'填写奖品名称',
            'description.required'=>'填写奖品描述',
        ]);
        $data=([
                'events_id'=>$request->events_id,
                'name'=>$request->name,
                'description'=>$request->description,
                'member_id'=>0,
        ]);
        EventPrize::create($data);

    }

}
