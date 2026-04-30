<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VilleController extends Controller
{
    public function index(): View
    {
        return view('admin.villes.index', ['villes' => Ville::orderBy('nom')->get()]);
    }

    public function create(): View
    {
        return view('admin.villes.form', ['ville' => new Ville()]);
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => ['required', 'string', 'max:255', 'unique:villes,nom']]);

        Ville::create($request->only('nom'));

        return redirect()->route('admin.villes.index')->with('success', 'Ville créée avec succès.');
    }

    public function edit(Ville $ville): View
    {
        return view('admin.villes.form', compact('ville'));
    }

    public function update(Request $request, Ville $ville)
    {
        $request->validate(['nom' => ['required', 'string', 'max:255', 'unique:villes,nom,' . $ville->id]]);

        $ville->update($request->only('nom'));

        return redirect()->route('admin.villes.index')->with('success', 'Ville mise à jour.');
    }

    public function destroy(Ville $ville)
    {
        $ville->delete();

        return redirect()->route('admin.villes.index')->with('success', 'Ville supprimée.');
    }
}
