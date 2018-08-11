<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    public function index(){
       $roles=Role::all();

        return view('admin.role.index',compact('roles'));
    }
   public function add(Request $request)
   {

       if ($request->isMethod('post')) {

               $name = $request->post('name');
//           dd($request->all());
               $role = Role::create(['name' => "$name", 'guard_name' => 'admin']);

               $role->syncPermissions($request->post('per'));
//    跳转
//           //跳转并提示
               return redirect()->route('role.index')->with('success', '创建' . $role->name . "成功");

           }
           $pers = Permission::all();
           return view('admin.role.add', compact('pers'));
       }

   public function edit(Request $request,$id){
    $role=Role::find($id);
    if($request->isMethod('post')){
        $name=  $request->post('name');
        $role->update(['name'=>"$name",'guard_name'=>'admin']);
//        同步更改
       $role->syncPermissions($request->post('per'));
        return redirect()->route('role.index')->with('success', '编辑' . $role->name . "成功");
    }

       $pers=Permission::all();
       return view('admin.role.edit',compact('pers','role'));
   }

//   删除
public function del(Request $request,$id){
    $role=Role::find($id);
    $role->delete();
//    并删除权限
$arr=$role->permissions()->pluck('name');
    foreach ($arr as $k=>$v){
            $role->revokePermissionTo($v);
    };
    return redirect()->route('role.index')->with('success','删除'.$role->name."成功");
}
}
