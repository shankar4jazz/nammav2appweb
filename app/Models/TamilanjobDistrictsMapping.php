<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamilanjobDistrictsMapping extends Model
{
    use HasFactory;
    protected $table = 'tamilanjobs_districts_mappings';
    protected $fillable = [ 'job_id', 'district_id' ];

    protected $casts = [
        'tamilanjob_id'   => 'integer',
        'district_id'   => 'integer',
    ];
    
    public function districts(){
        return $this->belongsTo(District::class,'district_id', 'id');
    }

    public function jobs(){
        return $this->belongsTo(TamilanJobs::class,'job_id', 'id');
    }
}

