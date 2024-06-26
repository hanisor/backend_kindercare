<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sickness extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'dosage',
        'date_time',
        'status',
        'child_id',
    
    ];
    public function child()
    {
        return $this->belongsTo(Child::class); // Assuming the foreign key is 'child_id'
    }

    public $timestamps = false;
}
