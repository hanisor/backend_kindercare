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
        'sender_type',
        'guardian_id',
        'caregiver_id',
    ];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardian_id');
    }

    public function caregiver()
    {
        return $this->belongsTo(Caregiver::class, 'caregiver_id');
    }

    public $timestamps = false;
}
