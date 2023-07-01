<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotherTongue extends Model
{
    use HasFactory;
    protected $table = "mm_mother_languages";
    protected $primaryKey = "id";

 
    
    public function mm_users()
    {
        return $this->hasMany(MatrimonialUsers::class, 'mother_tongue_id','id');
    }
}
