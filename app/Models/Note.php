<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail',
        'status',
        'date_time',
        'guardian_id',
        'caregiver_id',
    ];

    public $timestamps = false;

}
