<?php

namespace App\Http\Controllers;

use App\Models\CrossOver;
use App\Models\Station;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'from_station' => ['required', 'string', 'exists:stations,slug'],
            'to_station' => ['required', 'string', 'exists:stations,slug']
        ]);

        $from_station = Station::where('slug', $request->from_station)->first();
        $to_station = Station::where('slug', $request->to_station)->first();

        $trips = Trip::where([
            'from_station_id' => $from_station->id,
            'to_station_id' => $to_station->id,
        ])->with([
            'seats' => function ($query) {
                return $query->free();
            }
        ])->get();

        $corss_overs = CrossOver::where('station_id', $from_station->id)->orWhere('station_id', $to_station->id)->with('trip.seats')->get();

        return response()->json([
            'trips' => $trips,
            'crossovers' => $corss_overs
        ]);
    }
}
