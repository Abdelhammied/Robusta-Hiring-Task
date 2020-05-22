<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function crossovers()
    {
        return $this->hasMany(CrossOver::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
