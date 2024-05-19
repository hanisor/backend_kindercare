<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    use HasFactory;

    protected $fillable = [
        'number'
    ];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'rfid_id');
    }


    public $timestamps = false;

}
