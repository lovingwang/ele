<?php

namespace App\Http\Controllers\Shop;


use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoryController extends BaseController
{
 public function index(Request $request){
     if(Auth::user()==null){
         //提示
         $request->session()->flash('danger',"对不起！你还没有登录");
//           跳转
         return redirect()->route('user.login');
     }else{
$shop_id=Auth::user()->shop_id;
//dd($shop_id);
 $menucategorys= MenuCategory::where('shop_id','=',$shop_id)->paginate(3);

     return view('shop.menucategory.index',compact('menucategorys'));}
 }
public function add(Request $request){
     $shop_id=Auth::user()->shop_id;
$shops=Shop::where('id','=',$shop_id)->get();
//dd($shops);
if($request->isMethod('post')){
 $this->validate($request,[
     'name'=>'required|max:20',
     'type_accumulation'=>'required',
//     'shop_id'=>'required',
     'description'=>'required',
     'is_selected'=>'required']);
// 得到所有数据


 $data=$request->post();
if($data['is_selected']==1){
           MenuCategory::where('is_selected','=',1)
                    ->where('shop_id','=',$shop_id)
                    ->update(['is_selected'=>0])   ;
}


    MenuCategory::create($data);
//提示
    $request->session()->flash('success',"添加成功");
//           跳转
    return redirect()->route('menu_categories.index');
}
return view('shop.menucategory.add',compact('shops'));
}

public  function  edit(Request $request,$id){
   $menucategory=  MenuCategory::find($id);
    $shop_id=Auth::user()->shop_id;
    $shops=Shop::where('id','=',$shop_id)->get();
    if($request->isMethod('post')){
        $this->validate($request,[
            'name'=>'required|max:20',
            'type_accumulation'=>'required',
//     'shop_id'=>'required',
            'description'=>'required',
            'is_selected'=>'required']);

        $data=$request->post();
        if($data['is_selected']==1){

          MenuCategory::where('is_selected','=',1)
                ->where('shop_id','=',$menucategory->shop_id)
                    ->update(['is_selected'=>0]);

        }

        $menucategory->update($data);
        $request->session()->flash('success',"修改成功");
//           跳转
        return redirect()->route('menu_categories.index');
    }

  return  view('shop.menucategory.edit',compact('shops','menucategory')) ;
}
    public  function  del(Request $request,$id)
    {
        $menucategory=  MenuCategory::find($id);

//        $shop_id=Auth::user()->shop_id;
//        dd($shop_id);
        $shops=Menu::where('category_id','=',$id)->first();

if($shops){

       $request->session()->flash('danger',"此分类下还有菜品，不能删除..");
//           跳转
        return redirect()->route('menu_categories.index');
}

//          $request->session()->flash('danger',"此分类下还有菜品，不能删除..");
//           跳转
//          return redirect()->route('menu_categories.index');

          $menucategory->delete();
          $request->session()->flash('danger',"删除成功");
//           跳转
          return redirect()->route('menu_categories.index');
//      }

    }
}
