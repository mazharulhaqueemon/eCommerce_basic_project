<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user(){
        // return $this->hasOne(User::class,'user_id');
        return $this->hasOne('App\Models\User','id','user_id');
        // 'id' in user table and user_id mention cart table

    }

    public function Product(){
        // return $this->hasOne(User::class,'user_id');
        return $this->hasOne('App\Models\Product','id','product_id');

    }


}
