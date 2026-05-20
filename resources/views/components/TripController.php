<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class TripController extends Controller
{
    /**
     * Get the price for a trip to a specific destination from Taza.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrice(Request $request)
    {
        $request->validate([
            'destination' => 'required|string',
        ]);

        $origin = 'TAZA'; // As specified in the prompt
        $destination = strtoupper($request->input('destination'));

        $tariffs = Config::get('tariffs.' . $origin);

        if ($tariffs && isset($tariffs[$destination])) {
            return response()->json(['price' => $tariffs[$destination]]);
        }

        return response()->json(['price' => null, 'message' => 'Price not found for this destination.'], 404);
    }
}