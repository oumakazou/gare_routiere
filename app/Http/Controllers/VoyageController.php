<?php

namespace App\Http\Controllers;

use App\Models\Societe; // Use Societe model instead of TransportCompany
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
            $arrivalCities = collect(); // For destination dropdown
            $societes = collect(); // For company dropdown

            return view('voyages.index', compact('voyages', 'suggestedCity', 'arrivalCities', 'societes'));
        }

        $search = $request->filled('search') ? '%' . trim($request->string('search')->toString()) . '%' : null;
        $destinationFilter = $request->filled('destination')
            ? $request->string('destination')->trim()->toString()
            : ($request->filled('ville_arrivee') ? $request->string('ville_arrivee')->trim()->toString() : null);
        $dateFilter = $request->filled('date_voyage') ? $request->date_voyage : $request->date;
        $companyFilter = $request->filled('company_id') ? $request->integer('company_id') : null;

        $query = Voyage::query()->with(['transportCompany'])

        // Apply general search filter across relevant fields
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('ville_arrivee', 'like', $search)
                        ->orWhere('ville_depart', 'like', $search)
                        ->orWhere('line_name', 'like', $search)
                        ->orWhereHas('transportCompany', function ($subQuery) use ($search) {
                            $subQuery->where('name', 'like', $search);
                        });
                });
            })
        // Filter by specific destination (arrival city name)
            ->when($destinationFilter, function ($query) use ($destinationFilter) {
                $query->where('ville_arrivee', 'like', '%' . $destinationFilter . '%');
            })
        // Filter by specific travel date
            ->when($dateFilter, function ($query) use ($dateFilter) {
                $query->whereDate('travel_date', $dateFilter);
            })
            // Filtrer par société de transport
            ->when($companyFilter, function ($query) use ($companyFilter) {
                $query->where('transport_company_id', $companyFilter);
            })
            // Filtrer par nom de ligne
            ->when($request->filled('line_name'), function ($query) use ($request) {
                $query->where('line_name', $request->line_name);
            });

        $voyages = $query
            ->orderBy('travel_date')
            ->orderBy('departure_time')
            ->paginate(12)
            ->withQueryString();

        // Logic for suggesting a city if no voyages are found
        $suggestedCity = null;
        if ($voyages->isEmpty() && ($request->filled('ville_arrivee') || $request->filled('destination'))) {
            $searchCity = $request->filled('destination')
                ? $request->string('destination')->trim()->lower()->toString()
                : $request->string('ville_arrivee')->trim()->lower()->toString();

            // Get all distinct arrival city names from available voyages
            $cities = Voyage::query()
                ->selectRaw('ville_arrivee as raw_city')
                ->whereNotNull('ville_arrivee')
                ->distinct()
                ->pluck('raw_city')
                ->unique();

            $bestScore = 0;
            foreach ($cities as $city) {
                similar_text($searchCity, mb_strtolower($city), $score);
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $suggestedCity = $city; // Suggest the closest city name
                }
            }
        }

        // Get all distinct arrival cities for the dropdown filter
        $arrivalCities = Voyage::query()
            ->selectRaw('ville_arrivee as raw_city')
            ->whereNotNull('ville_arrivee')
            ->distinct()
            ->pluck('raw_city')
            ->sort()
            ->values();

        $lines = Voyage::query()->whereNotNull('line_name')->distinct()->pluck('line_name');
        $societes = \App\Models\TransportCompany::all();
        $transportCompanies = \App\Models\TransportCompany::pluck('name', 'id');

        return view('voyages.index', compact(
            'voyages',
            'suggestedCity',
            'arrivalCities',
            'societes',
            'transportCompanies',
            'lines'
        ));
    }

    public function show(Voyage $voyage): View
    {
        $voyage->load(['villeDepart', 'villeArrivee', 'autocar.societe', 'autocar.equipements', 'autocar.options', 'typeVoyage']);

        return view('voyages.show', compact('voyage'));
    }
}
