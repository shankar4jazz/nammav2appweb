<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class JobsViews extends Model
{

    protected $table = 'jobs_views';
    protected $fillable = [
        'jobs_id', 'datetime', 'count'
    ];

    public $timestamps = false;
    protected $casts = [
        'jobs_id'     => 'integer'
    ];

    public function jobs()
    {
        return $this->belongsTo(Jobs::class, 'jobs_id', 'id');
    }

}
