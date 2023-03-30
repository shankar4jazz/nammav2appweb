<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class 


Company extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,SoftDeletes;
    protected $table = 'companies';
    protected $fillable = [
        'user_id', 'name', 'status'
    ];

    protected $casts = [
        'user_id'    => 'integer',
        'status'    => 'integer',
    ];
    public function users(){
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }


}
