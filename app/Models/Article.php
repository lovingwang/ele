<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  public  $fillable=['name','content','start_time','end_time'];
}
