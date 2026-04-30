<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocieteController extends Controller
{
    public function index(): View
    {
        return view('admin.societes.index', ['societes' => Societe::orderBy('nom')->get()]);
    }

    public function create(): View
    {
        return view('admin.societes.form', ['societe' => new Societe()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:societes,nom'],
            'contact' => ['nullable', 'string', 'max:255'],
        ]);

        Societe::create($request->only('nom', 'contact'));

        return redirect()->route('admin.societes.index')->with('success', 'Société créée.');
    }

    public function edit(Societe $societe): View
    {
        return view('admin.societes.form', compact('societe'));
    }

    public function update(Request $request, Societe $societe)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:societes,nom,' . $societe->id],
            'contact' => ['nullable', 'string', 'max:255'],
        ]);

        $societe->update($request->only('nom', 'contact'));

        return redirect()->route('admin.societes.index')->with('success', 'Société mise à jour.');
    }

    public function destroy(Societe $societe)
    {
        $societe->delete();

        return redirect()->route('admin.societes.index')->with('success', 'Société supprimée.');
    }
}
