<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderLeads extends Model
{
    use HasFactory;
    protected $table = 'provider_leads';
    protected $fillable = [
        'name', 'address', 'mobile', 'service_name'
    ];
}
