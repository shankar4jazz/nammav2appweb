<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCallActivities extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'jobs_call_activities';
    protected $fillable = [
        'job_id', 'jobseeker_id', 'activity_type', 'activity_message','datetime'
    ];

    protected $casts = [
        'job_id'     => 'integer',
        'jobseeker_id'    => 'integer',
    ];

    public function jobs(){
        return $this->belongsTo(Jobs::class, 'job_id','id');
    }
    public function jobseeker(){
        return $this->belongsTo(User::class, 'jobseeker_id','id');
    }
    
}
