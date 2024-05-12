<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function sicknesses()
    {
        return $this->hasMany(Sickness::class);
    }

    public function child_relative() // Corrected method name
    {
        return $this->hasMany(ChildRelative::class);
    }

    public function relatives()
    {
        return $this->hasMany(ChildRelative::class, 'child_id');
    }
}
