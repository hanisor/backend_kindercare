<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'my_kid_number',
        'gender',
        'date_of_birth',
        'allergy',
        'guardian_id',
        
    ];

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

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'child_groups', 'child_id', 'group_id');
    }
}
