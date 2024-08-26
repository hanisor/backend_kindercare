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

     // Hidden attributes
     protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'groups');
    }

     public $timestamps = false;

     public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

}
