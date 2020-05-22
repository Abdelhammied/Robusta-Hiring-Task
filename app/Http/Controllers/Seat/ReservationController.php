<?php

namespace App\Http\Controllers\Seat;

use App\Models\Seat;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function showReservationForm(Seat $seat)
    {
        if ($seat->status !== 'free' && $seat->user_id !== auth()->id()) {
            return view('seat.not-available', compact('seat'));
        }

        $seat->setStatusToReservationInProgress();

        return view('seat.reserve', compact('seat'));
    }

    public function confirmSeatReservation(Seat $seat)
    {
        $seat->setStatusToReserved();

        return redirect()->route('home')->with('message', 'Seat Reserved Successfully');
    }
}
