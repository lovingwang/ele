<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()==null){
            //提示
            $request->session()->flash('danger',"对不起！你还没有登录");
//           跳转
            return redirect()->route('user.login');
        }else {
//          接收选择的搜索种类
                       $kind=$request->post('category_id');
            $min_price=$request->post('min_price');
            $max_price=$request->post('max_price');
            $search=$request->post('search');

//       $data=$request->query();
//       dd($search);

            $shop_id = Auth::user()->shop_id;

            $query = Menu::orderBy('id')->where('shop_id', '=', $shop_id);
//                ->where('category_id','=',$kind);

if($kind!==null){
    $query->where('category_id','=',$kind);
}
if($min_price!==null){
    $query->where('goods_price','>=',$min_price);
}
if($max_price!==null){
    $query->where('goods_price','<=',$max_price);
}
if($search!==null){
    $query->where('goods_name','like',"%$search%");
}
$menuses=$query->paginate(2);

            //得到搜索栏菜品分类
            $menu_categories = MenuCategory::where('shop_id','=',$shop_id)->get();

            //显示视图1
            return view('shop.menus.index', compact('menuses','min_price','max_price','search','kind', 'menu_categories'));
        }
    }
//添加
    public function add(Request $request){

        $shop_id=Auth::user()->shop_id;
        $shops=Shop::where('id',$shop_id)->get();
        $menu_categories=MenuCategory::where('shop_id','=',$shop_id)->get();
        if($request->isMethod('post')){
//            判断健壮
            $this->validate($request,[
                'goods_name'=>'required|max:20',
                 'goods_price'=>'required',
                'description'=>'required',
                'tips'=>'required',
            ]);
            $data=$request->post();
            $data['goods_img']='';
//            if($request->file('goods_img')){
//
//                $data['goods_img']=$request->file('goods_img')->store('menu','img');
//            }
            $file=$request->file('goods_img');
//            dd($file);
            if ($file!==null){
                //上传文件

                $fileName= $file->store("menu","oss");
//             dd($fileName);
    $data['goods_img']="https://lovingwang.oss-cn-shenzhen.aliyuncs.com/$fileName";
            }

//         dd($data);
                   Menu::create($data);
//                   提示
            $request->session()->flash('success',"添加成功");
//           跳转
            return redirect()->route('menu.index');

        }

   return view('shop.menus.add',compact('menu_categories','shops'));
    }

    public  function  edit(Request $request,$id){
        //得到当前这条
      $menu=Menu::find($id);
        $shop_id=Auth::user()->shop_id;
//        通过Auth筛选出满足自己条件的
        $shops=Shop::where('id',$shop_id)->get();
        $menu_categories=MenuCategory::where('shop_id','=',$shop_id)->get();
        if($request->isMethod('post')) {
//            判断健壮
            $this->validate($request, [
                'goods_name' => 'required|max:20',
                'goods_price' => 'required',
                'description' => 'required',
                'tips' => 'required',
            ]);
            $data = $request->post();
//            删除原来的图片
            $img=$menu->goods_img;
            File::delete($img);
//
////            $data['goods_img'] = '';
////            if ($request->file('goods_img')) {
////
////                $data['goods_img'] = $request->file('goods_img')->store('menu', 'img');
////            }
            $data['goods_img']='';

            $file=$request->file('goods_img');
//            dd($file);
            if ($file!==null){
                //上传文件

                $fileName= $file->store("menu","oss");
//             dd($fileName);
                $data['goods_img']="https://lovingwang.oss-cn-shenzhen.aliyuncs.com/$fileName";
            }

            $menu->update($data);
            $request->session()->flash('success',"修改成功");
//           跳转
            return redirect()->route('menu.index');

        }
        return view('shop.menus.edit',compact('menu_categories','shops','menu'));

    }


    public function del(Request $request,$id){

        $menu=Menu::find($id);
        $filename=$menu->goods_img;
        File::delete($filename);
        $menu->delete();

        $request->session()->flash('danger',"删除成功");
//           跳转
        return redirect()->route('menu.index');

    }


}
