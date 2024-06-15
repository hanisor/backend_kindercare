<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'caregiver_id',
        'time'
    ];

    public function children()
    {
        return $this->belongsToMany(Child::class, 'child_groups', 'group_id', 'child_id');
    }

    public function caregivers()
    {
        return $this->belongsToMany(Caregiver::class, 'groups');
    }

    public $timestamps = false;

}
