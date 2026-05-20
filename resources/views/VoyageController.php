<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voyage;
use App\Models\Ville;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    public function index()
    {
        $voyages = Voyage::with(['villeDepart', 'villeArrivee'])->latest()->paginate(10);
        return view('admin.voyages.index', compact('voyages'));
    }

    public function create()
    {
        $villes = Ville::all();
        return view('admin.voyages.create', compact('villes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ville_depart_id' => 'required|exists:villes,id',
            'ville_arrivee_id' => 'required|exists:villes,id',
            'date_depart' => 'required|date',
            'prix' => 'required|numeric',
            'places_disponibles' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('voyages', 'public');
        }

        Voyage::create($data);
        return redirect()->route('admin.voyages.index')->with('success', 'Voyage créé avec succès.');
    }

    public function destroy(Voyage $voyage)
    {
        $voyage->delete();
        return back()->with('success', 'Voyage supprimé.');
    }
}
