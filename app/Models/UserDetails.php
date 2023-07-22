<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserDetails extends Model 
{
    
    protected $table = 'user_details';
    protected $fillable = [
        'first_districts', 'districts', 'user_id','category', 'fav_jobs',
    ];

    protected $casts = [
        'user_id'    => 'integer',
        
    ];

    public function users(){

        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
        
    }


}
