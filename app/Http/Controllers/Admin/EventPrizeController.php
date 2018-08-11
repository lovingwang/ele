<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EventPrizeController extends BaseController
{
    public function  index(){
        $prizes=EventPrize::paginate(3);
//        返回抽奖内容
        $events=Event::all();
        return view('admin.eventPrize.index',compact('prizes'));
    }
    public function add(Request $request){
        if($request->isMethod('post')){

            $this->validate($request, [
                'name' => 'required',
                'event_id' => 'required',
                'description' => 'required',
            ]);

//dd($data['event_id']);
//            开奖前可以给该活动添加、修改、删除奖品]
//            还有个就是添加的产品不能大于限制的报名数
            $event= Event::where('id',$request->post('event_id'))->first();

            if($event->start_time<time()){
                return redirect()->route('eventPrize.add')->with('danger',"报名时间已经开始，不能添加");
            }
//得到当前报名总数
            $num=$event->num;
//            得到目前的奖品添加了多少了
            $query= EventPrize::where('event_id', $request->post('event_id'))
                ->Select(DB::raw("count(*) AS count "))->first();
//dd($query->count);
if($query->count>=$num){
    return redirect()->route('eventPrize.index')->with('danger',"奖品不能多于报名数，不能添加");
}
      if($event->is_prize==1){

          return redirect()->route('eventPrize.add')->with('danger',"抽奖活动已结束，不能添加");

      } ;

            $data=$request->all();
//            还没有开始抽奖 默认o
            $data['user_id']=0;
            EventPrize::create($data);
            return redirect()->route('eventPrize.index')->with('success',"添加成功");

        }
//        显示视图//        返回抽奖内容
        $events=Event::all();
        return view('admin.eventPrize.add',compact('events'));
    }

    public function edit(Request $request,$id){
        $prize=EventPrize::find($id);
       $events= Event::all();
       if($request->isMethod('post')){
           $this->validate($request, [
               'name' => 'required',
               'event_id' => 'required',
               'description' => 'required',
           ]);

           //dd($data['event_id']);
//            开奖前可以给该活动添加、修改、删除奖品]
           if(Event::where('id',$request->post('event_id'))->first()->start_time<time()){

               return redirect()->route('eventPrize.index')->with('danger',"活动已经开始，不能修改");
           }
           if( Event::where('id',$request->post('event_id'))->first()->is_prize==1){

               return redirect()->route('eventPrize.index')->with('danger',"抽奖活动已结束，不能修改");

           } ;
//           活动开始后也不能添加和修改奖品

           $data=$request->all();
//dd($data);
//            还没有开始抽奖 默认o
           $data['user_id']=0;
           $prize->update($data);
           return redirect()->route('eventPrize.index')->with('warning',"编辑成功");
       }

        return view('admin.eventPrize.edit',compact('events','prize'));
    }


    public function del(Request $request,$id){
        $prize=EventPrize::find($id);

        if( Event::where('id',$prize->event_id)->first()->start_time<time()){
            return redirect()->route('eventPrize.index')->with('danger',"抽奖活动已开始，不能删除");

           } ;
        if( Event::where('id',$prize->event_id)->first()->prize_id==1){
            return redirect()->route('eventPrize.index')->with('danger',"抽奖已结束，不能删除");

        } ;
        $prize=EventPrize::find($id);
        $prize->delete();

        return redirect()->route('eventPrize.index')->with('danger',"删除成功");
    }
//奖品中奖展示
    public function winner(Request $request,$id){
//dd($id);
   $prizes=EventPrize::where('event_id',$id)->paginate(3);
//   dd($prizes);

    return view('admin.eventPrize.winner',compact('prizes'));
    }
}
