<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public $fillable=[
        'goods_name','rating','shop_id','category_id',
        'goods_price','description','month_sales','rating_count',
        'tips','satisfy_count','satisfy_rate','goods_img','status'
    ];
//设置外键访问菜单分类名
    public function categories(){
        return $this->belongsTo(MenuCategory::class,'category_id');
    }

    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }



}
