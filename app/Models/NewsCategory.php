<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia,SoftDeletes;
    protected $table = 'news_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'description', 'is_featured', 'status' , 'color', 'tamil_name'
    ];
    protected $casts = [
        'status'    => 'integer',
        'is_featured'  => 'integer',
    ];

    public function news(){
        return $this->hasMany(News::class, 'news_category_id','id');
    }
    
    public function scopeList($query)
    {
        return $query->orderBy('deleted_at', 'asc');
    }
}
