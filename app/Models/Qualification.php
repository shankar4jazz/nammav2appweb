<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $table = "qualifications";
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'short_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(EducationCategory::class, 'category_id');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'qualification_id');
    }
}
