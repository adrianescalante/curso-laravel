<?php

namespace LaraDex;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //devuelve la relacion de rol con usuario
    public function users(){
        return $this->belongsToMany('LaraDex\User');
    }
}
