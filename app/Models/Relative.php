<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'relation',
        'phone_number',
        'date_time',
        'child_id',
    
    ];

    public $timestamps = false;
}
