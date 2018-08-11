<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class NavController extends BaseController
{

    public function index(){
        $navs=Nav::paginate(5);
       return view('admin.nav.index',compact('navs'));
    }
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {

//            dd($request->all());
            $this->validate($request, [
                'name' => 'required',
            ]);
//    判断url是不是存在
            if ($request->post('url') === null) {
                $data = $request->except('url');
            } else {
                $data = $request->post();
            }
            $nav = Nav::create($data);
            return redirect()->refresh()->with('success', '添加' . $nav->name . '成功');
        }

//        得到所有url
        $routes=Route::getRoutes();

        //定义数组
        $urls=[];
        foreach ($routes as $k=>$value){
//            dd($value->action);
            if ($value->action['namespace']==="App\Http\Controllers\Admin"){
//     dump($value->action['as']);
                if (isset($value->action['as'])){
                    $urls[]=$value->action['as'];
                }
            }
        }
//得到父级
//       var_dump($urls);
        $navs=Nav::where('pid',0)->orderBy('sort')->get();
        return view('admin.nav.add',compact('navs','urls'));
    }

//    编辑
public function edit(Request $request,$id){
        $nav=Nav::find($id);

//        得到所有url
    $routes=Route::getRoutes();
    //定义数组
    $urls=[];
    foreach ($routes as $k=>$value){
        //dd($value->action);
        if ($value->action['namespace']==="App\Http\Controllers\Admin"){
            if (isset($value->action['as'])){
                $urls[]=$value->action['as'];
            }
        }
    }
    if ($request->isMethod('post')) {

        $this->validate($request, [
            'name' => 'required',
        ]);
//    判断url是不是存在
        if ($request->post('url') === null) {
            $data = $request->except('url');
        } else {
            $data = $request->post();
        }

        $nav->update($data);
      return redirect()->route("nav.index")->with('success', '编辑' . $nav->name . '成功');

    }



//得到父级
    $navs=Nav::where('pid',0)->orderBy('sort')->get();
//        echo 11;exit;


        return view('admin.nav.edit',compact('urls','navs','nav'));

}

public function del(Request $request,$id){
//        得到当前
    $nav=Nav::find($id);
//    得到所有父级中的pid
//    然后判断里面有没有值相等，如果父级中没得就可以删除
if(Nav::where('pid',$id)->first()){

    return back()->with('danger', '不能删除');

};
$nav->delete();
    return redirect()->route("nav.index")->with('danger', '删除成功');

}
}



