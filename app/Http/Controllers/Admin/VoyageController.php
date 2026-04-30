<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Autocar;
use App\Models\TypeVoyage;
use App\Models\Ville;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VoyageController extends Controller
{
    public function index(): View
    {
        return view('admin.voyages.index', ['voyages' => Voyage::with('villeDepart', 'villeArrivee', 'autocar', 'typeVoyage')->orderBy('date_depart')->get()]);
    }

    public function create(): View
    {
        return view('admin.voyages.form', [
            'voyage' => new Voyage(),
            'villes' => Ville::orderBy('nom')->get(),
            'autocars' => Autocar::with('societe')->orderBy('matricule')->get(),
            'typeVoyages' => TypeVoyage::orderBy('nom')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ville_depart_id' => ['required', 'exists:villes,id'],
            'ville_arrivee_id' => ['required', 'exists:villes,id'],
            'date_depart' => ['required', 'date'],
            'heure_depart' => ['required', 'date_format:H:i'],
            'heure_arrivee' => ['required', 'date_format:H:i'],
            'autocar_id' => ['required', 'exists:autocars,id'],
            'type_voyage_id' => ['required', 'exists:type_voyages,id'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'is_special' => ['nullable', 'boolean'],
        ]);

        Voyage::create($request->only('ville_depart_id', 'ville_arrivee_id', 'date_depart', 'heure_depart', 'heure_arrivee', 'autocar_id', 'type_voyage_id', 'base_price', 'is_special'));

        return redirect()->route('admin.voyages.index')->with('success', 'Voyage créé avec succès.');
    }

    public function edit(Voyage $voyage): View
    {
        return view('admin.voyages.form', [
            'voyage' => $voyage,
            'villes' => Ville::orderBy('nom')->get(),
            'autocars' => Autocar::with('societe')->orderBy('matricule')->get(),
            'typeVoyages' => TypeVoyage::orderBy('nom')->get(),
        ]);
    }

    public function update(Request $request, Voyage $voyage)
    {
        $request->validate([
            'ville_depart_id' => ['required', 'exists:villes,id'],
            'ville_arrivee_id' => ['required', 'exists:villes,id'],
            'date_depart' => ['required', 'date'],
            'heure_depart' => ['required', 'date_format:H:i'],
            'heure_arrivee' => ['required', 'date_format:H:i'],
            'autocar_id' => ['required', 'exists:autocars,id'],
            'type_voyage_id' => ['required', 'exists:type_voyages,id'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'is_special' => ['nullable', 'boolean'],
        ]);

        $voyage->update($request->only('ville_depart_id', 'ville_arrivee_id', 'date_depart', 'heure_depart', 'heure_arrivee', 'autocar_id', 'type_voyage_id', 'base_price', 'is_special'));

        return redirect()->route('admin.voyages.index')->with('success', 'Voyage mis à jour.');
    }

    public function destroy(Voyage $voyage)
    {
        $voyage->delete();

        return redirect()->route('admin.voyages.index')->with('success', 'Voyage supprimé.');
    }
}
