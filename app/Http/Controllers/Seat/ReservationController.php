<?php

namespace App\Http\Controllers\Seat;

use App\Models\Seat;
use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function showReservationForm(Request $request, Seat $seat)
    {
        $request->validate([
            'from' => ['nullable', 'string', 'exists:stations,slug'],
            'to' => ['nullable', 'string', 'exists:stations,slug'],
        ]);

        if ($seat->status !== 'free' && $seat->user_id !== auth()->id()) {
            return view('seat.not-available', compact('seat'));
        }

        if ($request->has('from') && $request->has('to')) {
            $from_station = Station::where('slug', $request->from)->first();
            $to_station = Station::where('slug', $request->to)->first();

            $seat->setStatusToReservationInProgress(false, $from_station->id, $to_station->id);
        } else {
            $seat->setStatusToReservationInProgress();
        }

        return view('seat.reserve', compact('seat'));
    }

    public function confirmSeatReservation(Seat $seat)
    {
        $seat->setStatusToReserved();

        return redirect()->route('home')->with('message', 'Seat Reserved Successfully');
    }
}
