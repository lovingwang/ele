<?php

namespace App\Http\Controllers\Admin;

use App\Mail\OrderShipped;
use App\Mail\PrizeShipped;
use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EventController extends BaseController
{
//    奖活动
public function index(){
    $events=Event::paginate(5);

    return view('admin.event.index',['events'=>$events]);
}
//添加活动
public function add(Request $request){
    if($request->isMethod('post')){

            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'prize_time' => 'required',

            ]);


        $data=$request->post();

        $data['start_time']=strtotime( $data['start_time']);
        $data['end_time']=strtotime( $data['end_time']);
        $data['prize_time']=strtotime($data['prize_time']);
//        dd($data);
//        给个默认值 未被抽奖
        $data['is_prize']=0;

   Event::create($data) ;
        $request->session()->flash('success',"添加成功");
//           跳转
        return redirect()->route('event.index');

    }

    return view('admin.event.add');
}

//编辑

public function edit(Request $request,$id){
$event=Event::find($id);
    if($request->isMethod('post')) {

        if( $event->start_time<time()){
            return redirect()->route('event.index')->with('danger',"抽奖活动已开始，不能编辑");

        } ;
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'prize_time' => 'required',

        ]);
        $data=$request->post();
        $data['start_time']=strtotime( $data['start_time']);
        $data['end_time']=strtotime( $data['end_time']);
        $data['prize_time']=strtotime($data['prize_time']);
//        dd($data);
//        给个默认值 未被抽奖
        $data['is_prize']=0;
        $event->update($data);
        return redirect()->route('event.index')->with("info","编辑成功");

    }
return view('admin.event.edit',compact('event'));
}
public function del(Request $request,$id){

   $event= Event::find($id);

    if( $event->start_time<time()){
        return redirect()->route('event.index')->with('danger',"抽奖活动已开始，不能删除");

    } ;

   if($event->is_prize==1){
       $request->session()->flash('danger',"已经开奖不能删除");
//           跳转
       return redirect()->route('event.index');
   }
   $event->delete();

}
//抽奖方法
public function bonus(Request $request,$id){
//    $event=Event::findOrFail($id);//获取抽奖的活动
////    //取出所有报名者
//  $users=EventUser::where('event_id',$id)->pluck('user_id')->toArray();
//
//    shuffle($users);//将抽奖者数组打乱
//////取出所有奖品
//   $prizes=EventPrize::where('event_id',$id)->get();
//    foreach ($prizes as $k=>$prize){
//        $prize->user_id=$users[$k];
//        $prize->save();
//        //得到用户信息
//        $user=User::findOrFail($users[$k]);
//        Mail::to($user)->send( new OrderShipped($prize));
//    }
//    $event->is_prize=1;
//    $event->save();


//    首先得到所有报名此活动的商家和奖品
//    dd($id);
    $eventusers= EventUser::where('event_id',$id)->pluck('user_id');
////    得到一个由商家构成的数组
////    定义一个空数组
   $userArray=$eventusers->toArray();
//
//var_dump($userArray);
////   得到对应的奖品
    $prizes=EventPrize::where('event_id',$id)->pluck('name');
//    dd($prizes);
    $prizeArray=$prizes->toArray();
//    打乱奖品
    shuffle($prizeArray);
$num=count($prizeArray);
//   var_dump($prizeArray);
    for ($x=0; $x<$num; $x++) {
//        //打乱抽奖人数组
        shuffle($userArray);

        if(!$userArray){
            break;
        }

        $dd=$prizeArray[0];
        $pr= EventPrize::where('name',$dd)->first();
        array_shift($prizeArray);
//        echo $dd;
        $aa=$userArray[0];
        $pr->update(['user_id'=>$aa]);
    $user= User::find($aa) ;
    $prize=EventPrize::where('user_id',$aa)->first();
//    dd($prize);
    Mail::to($user)->send(new PrizeShipped($prize));
        array_shift($userArray);

    }

////        改变抽奖状态:
       $event= Event::find($id);
    $event->is_prize=1;
    $event->save();

   return redirect()->route('event.index')->with("success","抽奖完毕");


}
//商家报名列表
public function list(Request  $request,$id){

    $eventusers= EventUser::where('event_id',$id)->paginate(5);
    return view('admin.event.list',compact('eventusers'));
}
//此活动对呀奖品
    public function prizeList(Request  $request,$id){

            $prizes=EventPrize::where('event_id',$id)->paginate(3);
//        返回抽奖内容
            $events=Event::all();
            return view('admin.event.prize',compact('prizes'));
    }

}
