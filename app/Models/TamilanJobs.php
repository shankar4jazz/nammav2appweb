<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class TamilanJobs extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    protected $table = 'tamilan_jobs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'job_role',
        'education',
        'gender',
        'marital_status',
        'experience',
        'min_salary',
        'max_salary',
        'description',
        'vacancy',
        'country_id',
        'state_id',
        'district_id',
        'city_id',
        'jobcategory_id',
        'plan_id',
        'user_id',
        'address',
        'pincode',
        'reason',
        'status',
        'is_featured',
        'start_date',
        'end_date',
        'company_name',
		'contact_number',
		'districts',
    ];

    protected $casts = [
        'user_id'   => 'integer',
        'status'    => 'integer',
        'is_featured'  => 'integer',
        'jobcategory_id'  => 'integer'
    ];

    public function jobscategory()
    {
        return $this->belongsTo(JobsCategory::class, 'jobcategory_id', 'id')->withTrashed();
    } 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
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
	public function tamilanjobDistricts()
    {
        return $this->belongsToMany(District::class, 'job_id', 'id');
    }
	public function tamilanjobDistrictsData()
    {
		 return $this->belongsToMany(District::class, 'tamilanjobs_districts_mappings', 'job_id');
      //  return $this->belongsToMany(TamilanjobDistrictsMapping::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function scopeMyJobs($query)
    {
        $user = auth()->user();
        // if ($user->hasRole('admin') || $user->hasRole('demo_admin')) {
        //     return $query;
        // }

        // if ($user->hasRole('provider')) {
        //     return $query->where('provider_id', $user->id);
        // }

        // if ($user->hasRole('user')) {
        //     return $query->where('customer_id', $user->id);
        // }

        // if ($user->hasRole('handyman')) {
        //     return $query->whereHas('handymanAdded', function ($q) use ($user) {
        //         $q->where('handyman_id', $user->id);
        //     });
        // }

        return $query;
    }


    public function scopeList($query)
    {
        return $query->orderBy('deleted_at', 'asc');
    }
}
