<?php

namespace App\Http\Controllers;

use App\Models\nav;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

    }
}
