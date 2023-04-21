<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsPlans extends Model
{
    use HasFactory;
    protected $table = 'jobs_plans';
    protected $fillable = [
        'title', 'identifier', 'type', 'tax', 'price', 'percentage', 'amount', 'total_amount', 'status', 'duration', 'description', 'trial_period', 'plan_type', 'plancategory_id'
    ];
    protected $casts = [
        'amount'    => 'double',
        'status'    => 'integer',
        'plancategory_id'    => 'integer',
    ];
    public function jobs()
    {
        return $this->belongsTo(Jobs::class, 'id', 'plan_id');
    }

    public function jobsplans()
    {
        return $this->belongsTo('App\Models\JobsPlanCategory', 'plancategory_id', 'id');
    }

    public function planlimit()
    {
        return $this->belongsTo(PlanLimit::class, 'id', 'plan_id');
    }

    public function staticdata()
    {
        return $this->belongsTo(StaticData::class, 'plan_type', 'id');
    }
}
