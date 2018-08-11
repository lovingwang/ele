<?php

namespace App\Http\Controllers\Shop;

use App\Models\Article;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    public function reg(Request $request)
    {

//        店铺分类信息且得到上线的分类
        $shopCategorys =ShopCategory::where("status", 1)->get();
        if ($request->isMethod("post")) {
//          设置健壮
//            dd($request->post());

//            更新店铺表
            $shop=new Shop();
//            设置店铺状态
            $shop->status=0;
            $shop->shop_img = "";
            //批量赋值
            $shop->fill($request->input());

//            图片上传
            $file = $request->file('shop_img');
            //判断是否上传了图片
            if ($file) {//存在就上传

                    $filename=$file->store('shop1','oss');
                    $shop['shop_img']="https://lovingwang.oss-cn-shenzhen.aliyuncs.com/$filename";

                //dd($shop->shop_img);
            }

            //开启事务
            DB::transaction(function () use ($shop,$request){

//
                $shop->save();
//      再添加用户信息

                User::create([
                    //  'email' => $request->input('email'),
                    'shop_id' => $shop->id,
                    'password' => bcrypt($request->input('password')),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'status'=>0,
                ]);
            });
            //添加成功
            $request->session()->flash('success', '注册成功');
            //跳转至添加页面
            return redirect()->route("user.login");

        }

//      显示视图
        return view('shop.user.reg', compact('shopCategorys'));
    }



//商户登录
    public  function  login(Request $request){
        if(Auth::user()){
            Auth::logout();
        }
        if($request->isMethod('post')){
            $this->validate($request,['name'=>'required',
                'password'=>'required',
            ]) ;
//        登d

//            当前用户的验证
            if( Auth::attempt(['name'=>$request->post('name'),
                'password'=>$request->post('password')
            ],$request->has('remember'))) {
//                dd(Auth::user()->status);
//                $users=DB::table('users')->where('name', $request->post('name'))->first();
//
//                $shops=DB::table('shops')->where('id', $users->shop_id)->first();

                if(Auth::user()->status==1){
                    $request->session()->flash("success", "登录成功");
                    return redirect()->route("user.index0");

                }else{
                    $request->session()->flash("warning", "正在审核中.....");
                    return redirect()->route("user.login");
                }

            }else{
                $request->session()->flash("danger", "密码或者账号错误.....");
                return redirect()->route("user.login");
            }

        }

        return view('shop.user.login');
    }

    public function change(Request $request){

//        dd($_POST);
//        验证旧密码与数据库中是不是一样

        if (Hash::check($request->password,Auth::user()->password )) {
//并修改
            Auth::user()->password=bcrypt($request->new_password);
            Auth::user()->save();
            $request->session()->flash('success',"密码修改成功！请重新登录");
            Auth::logout();
            return view('shop.user.login');

        }

        return view('shop.user.change');
    }


//商户注销
    public  function  logout(Request $request){

        Auth::logout();

        $request->session()->flash("danger","退出成功");
        //跳转
        return view('shop.user.login');

    }

    public function index0(){

        return view('shop.user.index0');
    }

    public function index1(){
//        得到当前时间
        $now=time();
        $ss=date('Y-m-d',$now);
        if($ss){

            $query=Article::where('start_time','<',$ss)->Where('end_time','>',$ss)
                ->orWhere('start_time','>',$ss);
        }
 $articles=$query->paginate(2);
        return view('shop.user.index1',compact('articles'));
    }


    public function index3(){

        return view('shop.user.index3');
    }


}
