<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ShopController extends BaseController
{

    public function index(){

//   得到所有数据
        $shops=Shop::paginate(2);
//        显示视图

        return view('admin.shop.index',compact('shops'));
    }

    public  function add(Request $request){
        $shopCategorys=ShopCategory::all();

        if($request->isMethod('post')){
//          判断健壮性
            $this->validate($request,[
                'shop_category_id'=>'required',
                'shop_name'=>'required|min:2' ,
                'shop_img'=>'required',
                'shop_rating'=>'required' ,
                'brand'=>'required' ,
                'fengniao'=>'required' ,
                'bao'=>'required' ,
                'piao'=>'required' ,
                'zhun'=>'required' ,
                'start_send'=>'required',
                'send_cost'=>'required',
                'notice'=>'required|min:2' ,
                'discount'=>'required|min:2' ,
//                'name'=>'required|min:2',
//                'email'=>'email',
//                'password'=>'required'
//  'status'=>'required''required|min:2'
            ]) ;

//            得到所有数据
    $shop=$request->all();

    $shop['shop_img']="";
    $shop['status']='1';
    if($request->file('shop_img')){
        $filename=$request->file('shop_img')->store('shop1','oss');
        $shop['shop_img']="https://lovingwang.oss-cn-shenzhen.aliyuncs.com/$filename";
    }
//添加数据            //开启事务
      DB::transaction(function () use ($shop,$request){
//            dd($shop);
         $data = Shop::create($shop);
        $id=$data->id;
//      再添加用户信息

                User::create([
                    //  'email' => $request->input('email'),
                    'shop_id' => $id,
                    'password' => bcrypt($request->input('password')),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]);
         });

//    提示信息
            $request->session()->flash('success',"添加成功");
//           跳转
            return redirect()->route('shop.index');
        }



        return view('admin.shop.add',compact('shopCategorys'));
    }

    public function edit(Request $request,$id){
        $shop=Shop::find($id);
//dd($shop);
//        得到相对应的user中的id
         $dd=User::where('shop_id',$shop->id)->first()->id;
      $user=User::find($dd);
//        商家分类 得到所有
        $shopCategorys=ShopCategory::where("status", 1)->get();
        if($request->isMethod('post')){
            $this->validate($request,[
                'shop_category_id'=>'required',
                'shop_name'=>'required|min:2' ,
                'shop_img'=>'required',
                'shop_rating'=>'required' ,
                'brand'=>'required' ,
                'fengniao'=>'required' ,
                'bao'=>'required' ,
                'piao'=>'required' ,
                'zhun'=>'required' ,
                'start_send'=>'required',
                'send_cost'=>'required',
                'notice'=>'required|min:2' ,
                'discount'=>'required|min:2' ,


            ]);
//             得到所有数据
            $data=$request->all();
//            dd($data);
//             删除之前的图片
            $img=$shop->shop_img;
            File::delete($img);
            $data['shop_img']="";
            if($request->file('shop_img')){
                $filename=$request->file('shop_img')->store('shop1','oss');
                $data['shop_img']="https://lovingwang.oss-cn-shenzhen.aliyuncs.com/$filename";
            }

          DB::transaction(function () use ($data,$shop,$user,$request) {
                $shop->update($data);

                $user->update([
                    //  'email' => $request->input('email'),
                    'shop_id' => $shop->id,
                    'password' => bcrypt($request->input('password')),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'status'=>0,
                ]);
            });
            $request->session()->flash("success","编辑成功");
//        跳转
            return redirect()->route("shop.index");

        }


        return view('admin.shop.edit',compact('shop','shopCategorys','user'));
    }


    public function del(Request $request,$id){
//        找到这条数据
        $shop= Shop::find($id);
        $id=User::where('shop_id',$shop->id)->first()->id;
        $user=User::find($id);

        $logo=$shop->shop_img;

//       删除之前的图片
        File::delete($logo);
        $user->delete();
        $shop->delete();
//        提示信息
        $request->session()->flash('danger','删除成功');
//    跳转
        return redirect()->route('shop.index');
    }


    public function check(Request $request,$id){
        $shop= Shop::find($id);
        $data=$request->all();
        $data['status']="1";

        $shop->update($data);
        $request->session()->flash("success","审核成功");
//        跳转
        return redirect()->route("shop.index");
    }



}
