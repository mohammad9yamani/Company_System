<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use Authenticatable instead of Model
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;

    protected $fillable = [
        'company_national_id',
        'name',
        'email',
        'phone',
        'phone_code',
        'photo',
        'info',
        'address',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

   
    
   /* public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
        */
}
