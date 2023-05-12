<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDevices extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'user_devices';
    protected $fillable = [
        'device_token', 'user_id'
    ];

    protected $casts = [
        'user_id'     => 'integer',       
    ]; 
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    
}
