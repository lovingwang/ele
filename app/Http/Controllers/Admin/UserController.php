<?php

namespace App\Http\Controllers\Admin;

use App\Mail\OrderShipped;
use App\Mail\UserShipped;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class UserController extends BaseController
{


// 商家用户的增删改查
    public function index(){


        $users=User::paginate(2);

        return view('admin.user.index',compact('users'));
    }

    public function edit(Request $request,$id)
    {


        $shopCategorys =ShopCategory::where("status", 1)->get();
        $user = User::find($id);


        $shop = Shop::find($user['shop_id']);

//    var_dump($shop['id']);exit;

        if ($request->isMethod('post')) {
////       判断健壮性
            $this->validate($request,
                ['name' => 'required|min:2|max:7',
                    'password' => 'required',
                    'email' => 'email',
                ]);
            $data=$request->all();
            $img=$user->shop_img;

            File::delete($img);

            $data['shop_img']="";
            if($request->file('shop_img')){
                $filename=$request->file('shop_img')->store('shop1','oss');
                $data['shop_img']="https://lovingwang.oss-cn-shenzhen.aliyuncs.com/$filename";
            }
//          dd($data);
            DB::transaction(function () use ($shop,$data,$user,$request){
                $shop->update($data);


                $user->update([
                    //  'email' => $request->input('email'),
                    'shop_id' => $shop->id,
                    'password' => bcrypt($request->input('password')),
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                ]);
            });

            //     编辑成功提示
            $request->session()->flash("success", "编辑成功");
//        跳转

            return redirect()->route("user.index");
        }

        //显示视图
        return view("admin.user.edit",compact('user','shop','shopCategorys'));
    }

    public function del(Request $request ,$id){
        $user = User::find($id);
        $shop = Shop::find($user['shop_id']);
//    dd($shop);

        DB::transaction(function () use ($user ,$shop){
            $user->delete();
            $shop->delete();
        });
        $request->session()->flash("danger", "删除成功");
//        跳转

        return redirect()->route("user.index");
    }


    public function reset(Request $request ,$id){
        $user = User::find($id);
//        dd($user->password);

        $user->password=bcrypt("123456");

        $user->save();
        $request->session()->flash("danger", "重置密码成功");
//        跳转

        return redirect()->route("user.index");

    }

    public function open(Request $request,$id){
        $user= User::find($id);
//dd($user);
       $user->status=1;

          $user->save();

          Mail::to($user)->send(new UserShipped($user));

//        跳转
        return redirect()->route("user.index");
    }
public function close(Request $request,$id){
        $user= User::find($id);

        $user->status=0;
        $user->save();

//        跳转
        return redirect()->route("user.index");
    }


    public function  info(){

        return view("admin.user.info");

    }

}
