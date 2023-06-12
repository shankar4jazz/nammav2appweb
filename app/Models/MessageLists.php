<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageLists extends Model
{
    use HasFactory;
    protected $table = 'message_lists';
    protected $fillable = [
        'title', 'description', 'image', 'device_id'
    ];
  

}
