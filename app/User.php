<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

// class User extends Model implements AuthenticatableContract, AuthorizableContract
class User extends Model
{
    // use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "users";
    protected $primaryKey = "id";
    protected $fillable = [
        'name', 'email','mobile','email_verified_at','password','remember_token','is_active','api_token'
    ];

    // protected $dates = ['started_at', 'published_at'];

    // protected $dateFormat = 'U';



    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password','email_verified_at','record_deleted','updated_at','created_at','remember_token','is_active','api_token'
    ];

    public function complaint(){
        return $this->hasMany('App\Complaint');
    }
}
