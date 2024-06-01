<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildGroup extends Model
{
    use HasFactory;

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    
    public $timestamps = false;

}
