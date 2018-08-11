<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Shop extends Model
{

    use Searchable;
    public $asYouType = true;

    public function toSearchableArray()
    {
     $array= $this->only('id', 'shop_name');
     return $array;

    }



    public $fillable=[
        'shop_category_id',
        'shop_name' ,
        'shop_img',
        'shop_rating' ,
        'brand' ,
        'on_time',
        'fengniao' ,
        'bao' ,
        'piao' ,
        'zhun' ,
        'start_send',
        'send_cost',
        'notice' ,
        'discount' ,
        'status',



    ];

    public function shopCategory(){

        return $this->belongsTo(ShopCategory::class,"shop_category_id");
    }
}
