<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    public $fillable=['name','user_id',"event_id","description"];

   public function event(){
     return  $this->belongsTo(Event::class,'event_id');
   }
    public function user(){
        return  $this->belongsTo(User::class,'user_id');
}
}
