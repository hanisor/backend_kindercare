<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\hasApiTokens;
use Illuminate\Foundation\Auth\User;


class Guardian extends Authenticatable implements AuthenticatableContract
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

    public function children()
    {
        return $this->hasMany(Child::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

     // Define the byEmail() method to retrieve a Guardian by email
     public function scopeByEmail($query, $email)
     {
         return $query->where('email', $email);
     }

     public function relatives()
    {
        return $this->hasMany(Relative::class);
    }
     
    /**
     * Indicates if the model should be timestamped
     * 
     *  @var bool
     * 
     */ 
     
     public $timestamps = false;
    

    }