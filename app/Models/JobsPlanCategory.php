<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobsPlanCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    protected $table = 'jobs_plan_category';
    protected $fillable = [
        'en_name', 'ta_name', 'ta_description', 'en_description', 'icon', 'status'
    ];

    protected $casts = [
        'status'    => 'integer'
    ];

    public function scopeList($query)
    {
        return $query->orderBy('deleted_at', 'asc');
    }


    public function getPlans()
    {
        return $this->hasMany(JobsPlans::class, 'plancategory_id', 'id');
    }

    public function getPlansData()
    {
        return $this->hasMany(AccessPlans::class, 'plancategory_id', 'id');
    }
}
