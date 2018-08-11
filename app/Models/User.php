<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    public $fillable=[

        'name',
        'email',
        'password',
        'shop_id',

    ];
    public  function detail(){

        return $this->hasOne(Shop::class,"id");
    }
}
