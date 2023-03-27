<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDistrictsMapping extends Model
{
    use HasFactory;
    protected $table = 'jobs_districts_mappings';
    protected $fillable = [ 'jobs_id', 'district_id' ];

    protected $casts = [
        'jobs_id'   => 'integer',
        'district_id'   => 'integer',
    ];
    
  
	 public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function jobs(){
        return $this->belongsTo(Jobs::class,'jobs_id', 'id');
    }
}

