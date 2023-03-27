<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = "districts";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'name', 'state_id','slug'
    ];
    
    protected $casts = [
        'district_id'    => 'integer',
        'state_id'         => 'integer',
    ];
    
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id','id');
    }
	public function jobs()
{
    return $this->belongsTo(Jobs::class);
}

	public function city()
    {
        return $this->hasMany(City::class, 'city_id','id');
    }
}

