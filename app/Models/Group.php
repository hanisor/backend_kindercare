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
        return $this->hasMany(ChildRelative::class, 'group_id');
    }

    public $timestamps = false;

}
