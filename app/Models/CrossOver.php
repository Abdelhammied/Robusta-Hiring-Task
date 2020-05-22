<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrossOver extends Model
{
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
