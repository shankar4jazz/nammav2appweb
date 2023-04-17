<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobsPayment extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'jobs_payments';
    protected $fillable = [ 'employer_id', 'job_id','plan_id', 'datetime', 'discount', 'total_amount', 'payment_type', 'txn_id','payment_id', 'signature','order_id', 'payment_status', 'order_id'. 'signature', 'payment_id', 'other_transaction_detail' ];

    protected $casts = [
        'job_id'    => 'integer',
        'employer_id'   => 'integer',
        'discount'      => 'double',
        'total_amount'  => 'double',
    ];
    
    public function customer(){
        return $this->belongsTo(User::class,'employer_id', 'id')->withTrashed();
    }
    public function booking(){
        return $this->belongsTo(Jobs::class,'job_id', 'id')->withTrashed();
    }
    public function scopeMyPayment($query)
    {
        $user = auth()->user();
        if($user->hasAnyRole(['admin', 'demo_admin'])){
            return $query;
        }

        if($user->hasRole('provider')) {
            return $query->whereHas('booking', function($q) use($user) {
                $q->where('provider_id', '=', $user->id);
            });
        }

        if($user->hasRole('user')) {
            return $query->where('customer_id', $user->id);
        }

        if($user->hasRole('handyman')) {
            return $query->whereHas('booking',function ($q) use($user) {
                $q->whereHas('handymanAdded',function($handyman) use($user){
                    $handyman->where('handyman_id',$user->id);
                });
            });
        }

        return $query;
    }

    public function jobs(){
        return $this->belongsTo(Jobs::class,'id', 'payment_id');
    }
}