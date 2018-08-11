<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    public function index(){
        $members=Member::paginate(2);
//        显示首页
        return view('admin/member/index',compact('members'));
    }

    public function add(Request $request){
        if($request->isMethod('post')) {
//        dd($request->all());
            $this->validate($request, [
                'username' => 'required',
                'tel' => 'required',
                'password' => 'required',
            ]);
            $data=$request->all();
            $data['status']=1;
            $data['password']=bcrypt(  $data['password']);
            Member::create($data);
            $request->session()->flash('success',"添加成功");
//        跳转
            return redirect()->route('member.index');

        }
        return view('admin/member/add');
    }
    public function edit(Request $request,$id){

        $member=Member::find($id);

     if($request->isMethod('post')) {
//      dd($request->all());
            $this->validate($request, [
                'username' => 'required',
                'tel' => 'required',
                'password' => 'required',
                'money'=>'required',
                'jifen'=>'required'

            ]);
            $data=$request->all();

            $data['password']=bcrypt($data['password']);
//            dd($data);
            $member->update($data);
            $request->session()->flash('success',"修改成功");
//        跳转
            return redirect()->route('member.index');
        }
        return view('admin/member/edit',compact('member'));
    }
    public  function  del(Request $request,$id){
        $member=Member::find($id);
        $member->delete();
        $request->session()->flash('danger',"删除成功");
//        跳转


    }
    public function  change(Request $request,$id){
        $member=Member::find($id);
        $member->status=0;
        $member->save();
        return redirect()->route('member.index');
    }
    public function  open(Request $request,$id){
        $member=Member::find($id);
        $member->status=1;
        $member->save();
        return redirect()->route('member.index');
    }


    public  function fill(Request $request,$id){
      $member= Member::find($id);
        if($request->isMethod('post')) {
//      dd($request->all());
            $this->validate($request, [
                'money' => 'required',
                'jifen' => 'required'

            ]);
         $data=$request->all();

         $data['money']=$member->money+$data['money'];
            $data['jifen']=$member->jifen+$data['jifen'];
           $member->update($data);
            return redirect()->route('member.index')->with('success','充值成功');
        }

        return view('admin.member.fill');
    }
}
