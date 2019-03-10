<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Eventcontroller extends Controller
{
    //
    public function index(){
        $events=Event::all();

        return view('event.index',compact('events'));
    }
    public function show(Event $event){
        $event=Event::find($event->id);
        $prizes=EventPrize::where('events_id',$event->id)->get();
        $Members=EventMember::where('member_id',Auth::user()->id)->where('events_id',$event->id)->first();
        return view('event.show',compact('event','Members','prizes'));
    }
    public function edit(Event $event){
       $data=[
            'events_id'=>$event->id,
            'member_id'=>Auth::user()->id,
       ];
       EventMember::create($data);
       return  redirect()->route('event.index')->with('info','报名成功');
    }
}
