<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class admin extends Authenticatable 
{
    // use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        public function validatePassword($inputPassword)
    {
        return $this->password === $inputPassword; // Basic example, replace with actual hash check if needed
    }
    
}

