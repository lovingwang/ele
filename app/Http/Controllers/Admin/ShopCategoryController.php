<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ShopCategoryController extends BaseController
{
    public function index(){
        //得到所有值

        $shops=ShopCategory::paginate(3);
//       显示视图
        return view('admin.shopCategory.index',compact('shops'));
    }
// 添加商家

    public  function  add(Request $request){

        if($request->isMethod('post')){
            //判断字段的健壮性
            $this->validate($request,
                ['name'=>'required|min:2|max:7',
                    'status'=>'required',
//                    'logo'=>'required',
                ]);
//
            $data=$request->all();
//   var_dump($data);exit;
            $data['logo']='';
            if($request->file('logo')){

                $filename= $request->file('logo')->store("shop","oss");
             $data['logo']="https://lovingwang.oss-cn-shenzhen.aliyuncs.com/$filename";
            }
//    dd($data);
//     //添加数据
            ShopCategory::create($data);
            $request->session()->flash("success","添加成功");
//        跳转
            return redirect()->route("shopCategory.index");
        }

        return view("admin.shopCategory.add");
    }

//编辑


    public  function  edit(Request $request, $id){
//   得到这数据条修改的
        $shop= ShopCategory::find($id);
//        dd($shop);
        if($request->isMethod('post')){

            $this->validate($request,
                ['name'=>'required|min:2|max:7',
                    'status'=>'required',
//                    'logo'=>'required',
                ]);
//
            $data=$request->all();

            $logo=$shop->logo;

            File::delete($logo);
//            dd(11);
            $data['logo']='';
            if($request->file('logo')){
                $filename= $request->file('logo')->store("shop","oss");
                $data['logo']="https://lovingwang.oss-cn-shenzhen.aliyuncs.com/$filename";
            }

//            dd($data);
//     //添加数据
            $shop->update($data);
            $request->session()->flash("success","编辑成功");
//        跳转
            return redirect()->route("shopCategory.index");

        }

//        显示视图
        return view("admin.shopCategory.edit",compact('shop'));
    }
//删除
    public function del(Request $request,$id){
//        找到这条数据
        $shop= ShopCategory::find($id);
        $logo=$shop->logo;

//       删除之前的图片
        File::delete($logo);
        $shop->delete();
//        提示信息
        $request->session()->flash('danger','删除成功');
//    跳转
        return redirect()->route('shopCategory.index');
    }

}
