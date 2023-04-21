<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobsReports extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'jobs_reports';
    protected $fillable = [
        'jobs_id', 'jobseeker_id', 'report_type', 'report_message','datetime'
    ];

    protected $casts = [
        'jobs_id'     => 'integer',
        'jobseeker_id'    => 'integer',
    ];

   public function jobs(){
        return $this->belongsTo(Jobs::class,'jobs_id', 'id');
    }
    public function jobseeker(){
        return $this->belongsTo(User::class, 'jobseeker_id','id');
    }
    
}
