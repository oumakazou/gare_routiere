<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EquipementController extends Controller
{
    public function index(): View
    {
        return view('admin.equipements.index', ['equipements' => Equipement::orderBy('nom')->get()]);
    }

    public function create(): View
    {
        return view('admin.equipements.form', ['equipement' => new Equipement()]);
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => ['required', 'string', 'max:255', 'unique:equipements,nom']]);

        Equipement::create($request->only('nom'));

        return redirect()->route('admin.equipements.index')->with('success', 'Équipement créé.');
    }

    public function edit(Equipement $equipement): View
    {
        return view('admin.equipements.form', compact('equipement'));
    }

    public function update(Request $request, Equipement $equipement)
    {
        $request->validate(['nom' => ['required', 'string', 'max:255', 'unique:equipements,nom,' . $equipement->id]]);

        $equipement->update($request->only('nom'));

        return redirect()->route('admin.equipements.index')->with('success', 'Équipement mis à jour.');
    }

    public function destroy(Equipement $equipement)
    {
        $equipement->delete();

        return redirect()->route('admin.equipements.index')->with('success', 'Équipement supprimé.');
    }
}
