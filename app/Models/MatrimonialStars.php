<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrimonialStars extends Model
{
   
    use HasFactory;
    protected $table = "mm_stars";
    protected $primaryKey = "id";

   
    
    public function mm_users()
    {
        return $this->hasMany(MatrimonialUsers::class, 'star_id','id');
    }
}
