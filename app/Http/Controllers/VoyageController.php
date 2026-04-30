<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Option;
use App\Models\TypeVoyage;
use App\Models\Ville;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

class VoyageController extends Controller
{
    public function index(Request $request): View
    {
        $query = Voyage::with(['villeDepart', 'villeArrivee', 'autocar.societe', 'autocar.equipements', 'autocar.options', 'typeVoyage', 'reservations']);

        // Search filters
        if ($request->filled('ville_depart')) {
            $query->where('ville_depart_id', $request->ville_depart);
        }

        if ($request->filled('ville_arrivee')) {
            $query->where('ville_arrivee_id', $request->ville_arrivee);
        }

        if ($request->filled('date')) {
            $query->whereDate('date_depart', $request->date);
        }

        if ($request->filled('type_voyage')) {
            $query->where('type_voyage_id', $request->type_voyage);
        }

        // Price range filter
        if ($request->filled('price_min')) {
            $priceMin = floatval($request->price_min);
            $query->where(function ($q) use ($priceMin) {
                $q->where('base_price', '>=', $priceMin)
                  ->orWhere(function ($subQ) use ($priceMin) {
                      $subQ->where('is_special', true)
                           ->whereRaw('base_price * 1.3 >= ?', [$priceMin]);
                  });
            });
        }

        if ($request->filled('price_max')) {
            $priceMax = floatval($request->price_max);
            $query->where(function ($q) use ($priceMax) {
                $q->where(function ($subQ) use ($priceMax) {
                    $subQ->where('is_special', false)
                         ->where('base_price', '<=', $priceMax);
                })
                ->orWhere(function ($subQ) use ($priceMax) {
                    $subQ->where('is_special', true)
                         ->whereRaw('base_price * 1.3 <= ?', [$priceMax]);
                });
            });
        }

        // Time filter
        if ($request->filled('time_period')) {
            if ($request->time_period === 'morning') {
                $query->whereTime('heure_depart', '>=', '05:00')
                      ->whereTime('heure_depart', '<', '12:00');
            } elseif ($request->time_period === 'evening') {
                $query->whereTime('heure_depart', '>=', '18:00')
                      ->whereTime('heure_depart', '<', '23:59');
            }
        }

        // Sorting
        $sort = $request->get('sort', 'date');
        if ($sort === 'price_asc') {
            $query->orderBy('base_price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('base_price', 'desc');
        } elseif ($sort === 'time') {
            $query->orderBy('date_depart', 'asc')->orderBy('heure_depart', 'asc');
        } else {
            $query->orderBy('date_depart', 'asc')->orderBy('heure_depart', 'asc');
        }

        $voyages = $query->paginate(10)->withQueryString();

        // Get filter options
        $villes = Ville::orderBy('nom')->get();
        $typeVoyages = TypeVoyage::orderBy('nom')->get();
        $equipements = Equipement::orderBy('nom')->get();
        $options = Option::orderBy('nom')->get();

        $searchParams = $request->only(['ville_depart', 'ville_arrivee', 'date', 'type_voyage', 'price_min', 'price_max', 'time_period', 'sort']);

        return view('voyages', compact('voyages', 'villes', 'typeVoyages', 'equipements', 'options', 'searchParams'));
    }

    public function show(Voyage $voyage): View
    {
        $voyage->load(['villeDepart', 'villeArrivee', 'autocar.societe', 'autocar.equipements', 'autocar.options', 'typeVoyage']);

        return view('voyages.show', compact('voyage'));
    }
}
