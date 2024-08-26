<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\hasApiTokens;
use Illuminate\Foundation\Auth\User;
use App\Notifications\CustomResetPassword;


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
        'status',
        'role',
        'rfid_id'
    ];

     // Hidden attributes
     protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function children()
    {
        return $this->hasMany(Child::class, 'guardian_id');
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

    public function rfids()
    {
        return $this->hasMany(Rfid::class, 'rfid_id');
    }
     
    /**
     * Indicates if the model should be timestamped
     * 
     *  @var bool
     * 
     */ 
     
     public $timestamps = false;

     public function sendPasswordResetNotification($token)
     {
         $this->notify(new CustomResetPassword($token));
     }

    }