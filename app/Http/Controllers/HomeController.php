<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $villes = Ville::orderBy('nom')->get();

        $voyages = Voyage::with(['villeDepart', 'villeArrivee', 'autocar.societe', 'autocar.equipements', 'autocar.options', 'typeVoyage'])
            ->when($request->filled('ville_depart'), fn ($query) => $query->where('ville_depart_id', $request->ville_depart))
            ->when($request->filled('ville_arrivee'), fn ($query) => $query->where('ville_arrivee_id', $request->ville_arrivee))
            ->when($request->filled('date'), fn ($query) => $query->whereDate('date_depart', $request->date))
            ->orderBy('date_depart')
            ->orderBy('heure_depart')
            ->get();

        return view('home', [
            'voyages' => $voyages,
            'villes' => $villes,
            'search' => $request->only(['ville_depart', 'ville_arrivee', 'date']),
        ]);
    }
}
