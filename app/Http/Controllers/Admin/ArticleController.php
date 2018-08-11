<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends BaseController
{
    public function index(Request $request){
        $time=$request->post('time');
//       得到当前时间
        $now=time();
        $ss=date('Y-m-d',$now);
        $data=$request->query();
        if($time==''){
            $arts=Article::orderBy('id');
        }else{
          $arts=Article::orderBy('id');
        if($time==0){
//判断是选择的未开始。未结束 还是已经结束
//        dd($request->post());
     $arts->where('start_time','>',$ss);

 }
        if($time==1){
//        dd($request->post());
            $arts->where('start_time','<',$ss)->where('end_time','>',$ss);

        }
        if($time==-1){
//        dd($request->post());
            $arts->where('end_time','<',$ss);

        }
        }
$articles=$arts->paginate(2);

//        显示视图
        return view('admin.article.index',['articles'=>$articles,'time'=>$time,'data'=>$data]);
    }

    public function add(Request $request){

    if($request->isMethod('post')){

//        dd($request->all());
        $this->validate($request,[
            'name'=>'required',
            'content'=>'required',
           'start_time'=>'date',
            'end_time'=>'date',

        ]);

        Article::create($request->post());
        //     编辑成功提示
        $request->session()->flash("success", "添加成功");
//        跳转

        return redirect()->route("article.index");

    }
//        显示视图
        return view('admin.article.add');
    }
public function edit(Request $request,$id){
    //得到当前
    $article=Article::find($id);
    if($request->isMethod('post')) {

///       健壮
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'start_time' => 'date',
            'end_time' => 'date',

        ]);

        $article->update($request->post());
        $request->session()->flash("warning", "编辑成功");
//        跳转

        return redirect()->route("article.index");
    }

//显示视图
    return view('admin.article.edit',compact('article'));
}

public  function  del(Request $request ,$id){
    $article=Article::find($id);
    $article->delete();

    $request->session()->flash("danger", "删除成功");
//        跳转

    return redirect()->route("article.index");
}






}
