<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
  public $fillable=['user_id','event_id'];

//  找到与user和event的关系
  public function user(){
      return $this->belongsTo(User::class,'user_id');

  }
    public function event(){
        return $this->belongsTo(Event::class,'event_id');

    }
}
