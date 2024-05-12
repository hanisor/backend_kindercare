<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildRelative extends Model
{
    use HasFactory;

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function relative()
    {
        return $this->belongsTo(Relative::class, 'relative_id');
    }
}
