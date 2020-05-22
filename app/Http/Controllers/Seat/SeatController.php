<?php

namespace App\Http\Controllers\Seat;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        return view('seat.index', [
            'seats'  => Seat::where('user_id', auth()->id())->reserved()->get()
        ]);
    }
}
