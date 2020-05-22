<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function from()
    {
        return $this->belongsTo(Station::class, 'from_station_id');
    }

    public function to()
    {
        return $this->belongsTo(Station::class, 'to_station_id');
    }
    
    public function crossovers()
    {
        return $this->hasMany(CrossOver::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
