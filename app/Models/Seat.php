<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Seat extends Model
{
    protected $guarded = ['id'];

    protected $with = [
        'bus',
        'trip',
        'user'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFree($query)
    {
        return $query->where('status', 'free');
    }

    public function scopeReserved($query)
    {
        return $query->where('status', 'reserved');
    }

    public function setStatusToFree()
    {
        return $this->update([
            'status' => 'free',
            'user_id' => null,
            'locked_at' => null,
            'check_in_at' => null,
            'check_out_at' => null,
            'reserved_from' => 'begin_of_the_trip',
            'reserved_untill' => 'last_of_the_trip',
        ]);
    }

    public function setStatusToReservationInProgress(bool $all_the_trip = true, int $check_in_at = null, int $check_out_at = null)
    {
        return $this->update([
            'status' => 'reservation-in-progress',
            'user_id' => auth()->id(),
            'locked_at' => now(),
            'reservation_uuid' => Uuid::uuid1(),
            'reserved_from' => $all_the_trip ? 'begin_of_the_trip' : 'specific_station',
            'reserved_untill' => $all_the_trip ? 'last_of_the_trip' : 'specific_station',
            'check_in_at' => $all_the_trip ? $this->trip->from_station_id : $check_in_at,
            'check_out_at' => $all_the_trip ? $this->trip->to_station_id : $check_out_at,
        ]);
    }

    public function setStatusToReserved()
    {
        return $this->update([
            'status' => 'reserved',
            'user_id' => auth()->id(),
            'locked_at' => null,
        ]);
    }
}
