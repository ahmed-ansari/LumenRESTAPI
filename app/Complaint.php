<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = "complaints";
    protected $primaryKey = "id";
    protected $fillable = [
        'title', 'desc', 'image_path','category','user_id'
    ];

    // protected $dates = ['started_at', 'published_at'];

    // protected $dateFormat = 'U';



    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'record_deleted','updated_at','created_at'
    ];

    // public function 
}
