<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'title', 'description', 'is_featured', 'status', 'news_category_id', 'tamil_title',
        'news_subcategory_id', 'youtube_url', 'state_id', 'district_id', 'city_id', 'country_id', 'is_featured', 'user_id', 'reject_reason'
    ];

    protected $casts = [
        'status'    => 'integer',
        'is_featured'  => 'integer',
        'news_category_id'  => 'integer',
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\NewsCategory', 'news_category_id', 'id')->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withTrashed();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'news_category_id', 'id');
    }
    // public function subcategory(){
    //     return $this->belongsTo('App\Models\NewsCategory','news_category_id','id')->withTrashed();
    // }
    // public function services(){
    //     return $this->hasMany(Service::class, 'subcategory_id','id');
    // }
    public function scopeList($query)
    {
        return $query->orderBy('deleted_at', 'asc');
    }
}
