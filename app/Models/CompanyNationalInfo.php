<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyNationalInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_national_id',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_national_id', 'company_national_id');
    }
}
