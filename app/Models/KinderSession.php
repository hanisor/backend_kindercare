<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KinderSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'year'
    ];

    public $timestamps = false;

}
