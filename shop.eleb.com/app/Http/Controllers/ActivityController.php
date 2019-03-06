<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function index(){
            $activities=Activity::all()->where('end_time','>',date('Y-m-d h:i:s'));
        return view('activity.index',compact('activities'));
    }
}
