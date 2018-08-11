<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends BaseController
{
    public  function index(){
        $events=Event::paginate(5);
        return view('shop.event.index',['events'=>$events]);
//
    }
//    报名
public  function join(Request $request,$id){
        $event_id=Event::find($id)->id;
      $user_id=Auth::user()->id;
    $query= EventUser::where('event_id', $event_id)->count();
//   dd($query);
    $num=Event::find($id)->num;
    if($query>=$num){
        return redirect()->route('prize.index')->with('danger',"对不起报名人数已满");
    };
if(EventUser::where('user_id',$user_id)->where('event_id',$event_id)->first()){

    return redirect()->route('prize.index')->with('danger',"对不起,你已经报过名了");

};
//dd($event_id)

    EventUser::create([
        'event_id'=>$event_id,
        'user_id'=>$user_id,
    ]);

    return redirect()->route('prize.index')->with('danger',"恭喜,报名成功");

}


//活动详情
public function  info(Request $request ,$id){
  $prizes=EventPrize::where('event_id',$id)->paginate(3);
  return view('shop.event.info',compact('prizes'));
}

//中奖纪录
public  function show(){

    $user_id=Auth::user()->id;
     $shows=  EventPrize::where('user_id',$user_id)->paginate(3) ;
     foreach ($shows as $show){
//         把e也同时写进shows、、压进数组 然后再传
         $show->e= Event::where('id',$show->event_id)->first()->title;

     }

     return view('shop.event.show',compact('shows'));
}
}
