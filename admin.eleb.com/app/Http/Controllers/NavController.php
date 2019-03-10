<?php

namespace App\Http\Controllers;

use App\Models\nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index(){
        $navs=nav::all();
        return view('nav.index',compact('navs'));
    }
    public function create(){
        $path=Permission::all();

        $navs=nav::where('pid',0)->get();
        return view('nav.add',compact('navs','path'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
            'pid'=>'required',
        ],[
            'name.required'=>'填写菜单名称',
            'url.required'=>'选择路由',
            'pid.required'=>'选择菜单等级',
        ]);
        $per=Permission::where('name',$request->url)->first();
        $pid=$request->pid?$request->pid:0;
        $data=[
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission_id,
        ];
        nav::create($data);
        return redirect()->route('nav.index')->with('info','添加成功');
    }
    public function destroy(Nav $nav)
    {
        $nav->delete();
        session()->flash('danger', '删除成功');
        return redirect()->route('nav.index');
    }
    public function edit(nav $nav){
        $path=Permission::all();
        $navs=nav::where('pid',0)->get();
        return view('nav.edit',compact('nav','path','navs'));
    }
    public function update(Request $request,nav $nav){
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
            'pid'=>'required',
        ],[
            'name.required'=>'填写菜单名称',
            'url.required'=>'选择路由',
            'pid.required'=>'选择菜单等级',
        ]);
        $per=Permission::where('name',$request->url)->first();
        $pid=$request->pid?$request->pid:0;
        $data=[
            'name'=>$request->name,
            'url'=>$request->url,
            'pid'=>$request->pid,
            'permission_id'=>$request->permission_id,
        ];
        $nav->update($data);
        return redirect()->route('nav.index')->with('info','修改成功');
    }
    public static function nav(){
    $navs=nav::all();
    $user=auth()->user();
        $html='';
    foreach ($navs as $nav){
        $son='';
        if(!$nav->pid){
            foreach ($navs as $nv){
                if($nv->pid==$nav->id){
                    if(Auth::user()->can($nv->permission->name)) {
                        $son .= '<li><a href="' . url($nv->url) . '">' . $nv->name . '</a></li>';
                    }
                }
        }
        if($son){
            $html.='<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav->name.'<span class="caret"></span></a>
        <ul class="dropdown-menu">
          '.$son.'
            <li role="separator" class="divider"></li>
        </ul>
    </li>';
        }
        }
    }
        return $html;
    }
}
