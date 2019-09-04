<?php

namespace LaraDex;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //devuelve la relacion de usuario con su rol
    public function roles(){
        return $this->belongsToMany('LaraDex\Role');
    }

    public function authorizeRoles($roles){
        if($this->hasAnyRole($roles)){
            return true;
        }
        abort(401, 'This action is unauthorized');
    }


    /*Logica para validacion de usuario*/
    //iteramos por si el usuario tiene mas de un rol
    public function hasAnyRole($roles){
        if(is_array($roles)){ //Si es un arreglo de roles
            foreach ($roles as $role) {
                if($this->hasRole($role)){
                return true;
            }
        }
    }
        else{                 //si no es un arreglo, un solo rol
            if($this->hasRole($roles)){
                return true;
            }

        }
        return false;
    }

    //verificamos si el usuario tiene un rol
    public function hasRole($role){
        if($this->roles()->where('name',$role)->first()){
            return true;
        }
        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
