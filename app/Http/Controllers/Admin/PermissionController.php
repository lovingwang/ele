<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
//    权限展示
    public function index(){
     $pers=   Permission::paginate(8);
        return view('admin.per.index',compact('pers'));
    }
//    权限添加
    public function add(Request $request){
//
////        得到所有路由  一键导入所有的权限表
//        $routes=Route::getRoutes();
////        dd($routes);
////定义数组
//        $urls=[];
//        foreach ($routes as $k=>$value) {
//
////           dump($value);
//            if ($value->action['namespace'] === "App\Http\Controllers\Admin") {
//                $urls[] = $value->action['as'];
//            }
//        }
////      dd($urls);
//        foreach ($urls as $url){
//            Permission::create(['name'=>$url,'guard_name'=>'admin']);
//        }
//一键权限结束
        if($request->isMethod('post')){
          $name=  $request->post('name')     ;


    $per=Permission::create(['name'=>"$name",'guard_name'=>'admin']);
//    跳转
            return redirect()->route('per.index')->with("success","添加成功");

        }
        return view('admin.per.add');
    }
//    权限修改
     public function edit(Request $request,$id){
$per= Permission::find($id);
//dd($per);
         if($request->isMethod('post')) {
             $data['name'] = $request->post('name');
             $data['guard_name']=$request->post('guard_name');
//dd($data);
             $per->update($data);
             return redirect()->route('per.index')->with("success","编辑成功");
         }

             return view('admin.per.edit',compact('per'));
}
//权限删除
public function del(Request $request ,$id){
    $per= Permission::find($id);
    $per->delete();
    return redirect()->route('per.index')->with("danger","删除成功");
}
}
