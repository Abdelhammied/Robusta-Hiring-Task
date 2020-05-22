<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'from_station' => ['required', 'string', 'exists:stations,slug'],
            'to_station' => ['required', 'string', 'exists:stations,slug']
        ]);
            
     
        return $request->all();
    }
}
