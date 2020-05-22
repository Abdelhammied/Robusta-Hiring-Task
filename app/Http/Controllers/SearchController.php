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

        $seats_query = [
            'seats' => function ($query) {
                return $query->free()->orWhere([
                    'status' => 'reservation-in-progress',
                ])->where('user_id', auth()->id());
            }
        ];

        $trips = Trip::where([
            'from_station_id' => $from_station->id,
            'to_station_id' => $to_station->id,
        ])->with($seats_query)->get();

        $corss_over_trips = Trip::whereHas('crossovers', function ($q) use ($from_station, $to_station) {
            $q->where([
                'station_id' => $from_station->id,
                'station_id' => $to_station->id,
            ]);
        })->with($seats_query)->get();


        return response()->json([
            'trips' => $trips,
            'corss_over_trips' => $corss_over_trips
        ]);
    }
}
