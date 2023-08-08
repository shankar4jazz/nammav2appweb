<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationCategory extends Model
{
    use HasFactory;

    protected $table = "qualification_categories";
    protected $primaryKey = "id";

    protected $fillable = [
        'qualification',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function qualifications()
    {
        return $this->hasMany(Qualification::class, 'category_id');
    }
}
