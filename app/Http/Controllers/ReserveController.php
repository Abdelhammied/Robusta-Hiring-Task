<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function reserveTripSeat($seat)
    {
        $seat = Seat::where('seat_uuid', $seat)->get();

        return $seat;
    }

    public function reserveCrossoverSeat()
    {
        # code...
    }
}
