<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'skill',
        'level',
        'date',
        'child_id',
    ];

    public $timestamps = false;
}
