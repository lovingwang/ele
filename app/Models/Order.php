<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable=['user_id','shop_id','sn','province','city','county','address','tel','name','total','status'];
//   建立order表与member之间的关系
   public function order(){
      return $this->belongsTo(Member::class,'user_id');
   }
//   建立shop表与member之间的关系
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }


    public function getOrderStatusAttribute()
    {
        $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];
        return $arr[$this->status];//-1 0 1 2 3
    }


}
