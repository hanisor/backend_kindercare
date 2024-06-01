<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time_arrive',
        'date_time_leave',
        'month',
        'child_group_id',
    ];

    public $timestamps = false;

    public function childGroup()
    {
        return $this->belongsTo(ChildGroup::class, 'child_group_id');
    }
}
