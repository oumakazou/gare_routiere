<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeVoyage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeVoyageController extends Controller
{
    public function index(): View
    {
        return view('admin.type_voyages.index', ['typeVoyages' => TypeVoyage::orderBy('nom')->get()]);
    }

    public function create(): View
    {
        return view('admin.type_voyages.form', ['type_voyage' => new TypeVoyage()]);
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => ['required', 'string', 'max:255', 'unique:type_voyages,nom']]);

        TypeVoyage::create($request->only('nom'));

        return redirect()->route('admin.type-voyages.index')->with('success', 'Type de voyage créé.');
    }

    public function edit(TypeVoyage $type_voyage): View
    {
        return view('admin.type_voyages.form', compact('type_voyage'));
    }

    public function update(Request $request, TypeVoyage $type_voyage)
    {
        $request->validate(['nom' => ['required', 'string', 'max:255', 'unique:type_voyages,nom,' . $type_voyage->id]]);

        $type_voyage->update($request->only('nom'));

        return redirect()->route('admin.type-voyages.index')->with('success', 'Type de voyage mis à jour.');
    }

    public function destroy(TypeVoyage $type_voyage)
    {
        $type_voyage->delete();

        return redirect()->route('admin.type-voyages.index')->with('success', 'Type de voyage supprimé.');
    }
}
