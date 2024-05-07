<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\hasApiTokens;
use Illuminate\Foundation\Auth\User;

class Caregiver extends Authenticatable implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'ic_number',
        'phone_number',
        'username',
        'email',
        'password',
        'image',
        'status',
        'role',
    ];

    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }

      /**
     * Indicates if the model should be timestamped
     * 
     *  @var bool
     * 
     */ 
     
     public $timestamps = false;

}
