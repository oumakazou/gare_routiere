<?php

namespace App\Http\Controllers;

use App\Models\Voyage;
use App\Models\Societe; // Import the Societe model
use App\Models\Ville;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    public function index(Request $request)
    {
        $query = Voyage::with(['villeDepart', 'villeArrivee', 'societe']);

        if ($request->filled('destination')) {
            $query->whereHas('villeArrivee', function($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->destination . '%');
            });
        }

        $voyages = $query->orderBy('date_depart', 'asc')->paginate(12);

        return view('voyages.index', compact('voyages'));
    }

    public function reserve(Voyage $voyage)
    {
        return view('reservations.create', compact('voyage'));
    }
}