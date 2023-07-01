<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatrimonialUsers extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    protected $table = 'mm_users';
    protected $primaryKey = 'id';
    protected $fillable = [
        "id",
        "user_id",
        "religion_id",
        "caste_id",
        "subcaste_id",
        "education",
        "mother_tongue_id",
        "your_work",
        "brothers",
        "sisters",
        "eating_habbits",
        "smoke_habbits",
        "drink_habbits",
        "family_status",
        "family_type",
        "family_value",
        "is_disability",
        "disability_details",
        "is_anycaste",
        "photo_urls",
        "own_property",
        "star_id",
        "gothram",
        "is_dhosam",
        "about_dhosam",
        "horoscope_urls",
        "address_proof_url",
        "plan_id",
        "status",
        "reject_reason",
        "marital_status",
        "height",
        "gender",
        "for_who",
        "about",
        "is_featured",
        'name',
        'dob',
        'salary'
    ];

    protected $casts = [
        'status'    => 'integer',
        'is_featured'  => 'integer',
        'user_id'  => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
