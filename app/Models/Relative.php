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

    public function children()
    {
        return $this->belongsToMany(Child::class, 'child_relative', 'relative_id', 'child_id');
    }

    public $timestamps = false;
}
