<?php

namespace App\Http\Controllers;

use App\Models\TransportCompany;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class VoyageController extends Controller
{
    public function index(Request $request): View
    {
        if (! Schema::hasTable('voyages')) {
            $voyages = collect();
            $suggestedCity = null;
            $arrivalCities = collect();
            $transportCompanies = collect();
            $lines = collect();

            return view('voyages.index', compact('voyages', 'suggestedCity', 'arrivalCities', 'transportCompanies', 'lines'));
        }

        $search = $request->filled('search') ? '%' . trim($request->string('search')->toString()) . '%' : null;
        $destinationFilter = $request->filled('destination')
            ? $request->string('destination')->trim()->toString()
            : ($request->filled('ville_arrivee') ? $request->string('ville_arrivee')->trim()->toString() : null);
        $dateFilter = $request->filled('date_voyage') ? $request->date_voyage : $request->date;

        $query = Voyage::query()->with('transportCompany')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('destination', 'like', $search)
                        ->orWhere('line_name', 'like', $search)
                        ->orWhere('observations', 'like', $search)
                        ->orWhereHas('transportCompany', function ($query) use ($search) {
                            $query->where('name', 'like', $search);
                        });
                });
            })
            ->when($destinationFilter, function ($query) use ($destinationFilter) {
                $query->where('destination', 'like', '%' . $destinationFilter . '%');
            })
            ->when($dateFilter, function ($query) use ($dateFilter) {
                $query->whereDate('travel_date', $dateFilter);
            })
            ->when($request->filled('company_id'), function ($query) use ($request) {
                $query->where('transport_company_id', $request->integer('company_id'));
            })
            ->when($request->filled('line_name'), function ($query) use ($request) {
                $query->where('line_name', 'like', '%' . $request->string('line_name')->trim() . '%');
            });

        $voyages = $query
            ->orderBy('travel_date')
            ->orderBy('departure_time')
            ->paginate(12)
            ->withQueryString();

        $suggestedCity = null;
        if ($voyages->isEmpty() && ($request->filled('ville_arrivee') || $request->filled('destination'))) {
            $searchCity = $request->filled('destination')
                ? $request->string('destination')->trim()->lower()->toString()
                : $request->string('ville_arrivee')->trim()->lower()->toString();

            $cities = Voyage::query()
                ->distinct()
                ->pluck('destination');

            $bestScore = 0;
            foreach ($cities as $city) {
                similar_text($searchCity, mb_strtolower($city), $score);
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $suggestedCity = $city;
                }
            }
        }

        $arrivalCities = Voyage::query()
            ->distinct()
            ->orderBy('destination')
            ->pluck('destination');

        $transportCompanies = Schema::hasTable('transport_companies')
            ? TransportCompany::query()
                ->orderBy('name')
                ->pluck('name', 'id')
            : collect();

        $lines = Voyage::query()
            ->distinct()
            ->orderBy('line_name')
            ->pluck('line_name');

        return view('voyages.index', compact('voyages', 'suggestedCity', 'arrivalCities', 'transportCompanies', 'lines'));
    }

    public function show(Voyage $voyage): View
    {
        $voyage->load(['villeDepart', 'villeArrivee', 'autocar.societe', 'autocar.equipements', 'autocar.options', 'typeVoyage']);

        return view('voyages.show', compact('voyage'));
    }
}
