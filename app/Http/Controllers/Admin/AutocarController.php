<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Autocar;
use App\Models\Equipement;
use App\Models\Option;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AutocarController extends Controller
{
    public function index(): View
    {
        return view('admin.autocars.index', ['autocars' => Autocar::with('societe')->orderBy('matricule')->get()]);
    }

    public function create(): View
    {
        return view('admin.autocars.form', [
            'autocar' => new Autocar(),
            'societes' => Societe::orderBy('nom')->get(),
            'equipements' => Equipement::orderBy('nom')->get(),
            'options' => Option::orderBy('nom')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricule' => ['required', 'string', 'max:255', 'unique:autocars,matricule'],
            'capacite' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'in:local,external'],
            'societe_id' => ['required', 'exists:societes,id'],
            'equipements' => ['array'],
            'equipements.*' => ['exists:equipements,id'],
            'options' => ['array'],
            'options.*' => ['exists:options,id'],
        ]);

        $autocar = Autocar::create($request->only('matricule', 'capacite', 'type', 'societe_id'));
        $autocar->equipements()->sync($request->input('equipements', []));
        $autocar->options()->sync($request->input('options', []));

        return redirect()->route('admin.autocars.index')->with('success', 'Autocar créé.');
    }

    public function edit(Autocar $autocar): View
    {
        return view('admin.autocars.form', [
            'autocar' => $autocar->load('equipements', 'options'),
            'societes' => Societe::orderBy('nom')->get(),
            'equipements' => Equipement::orderBy('nom')->get(),
            'options' => Option::orderBy('nom')->get(),
        ]);
    }

    public function update(Request $request, Autocar $autocar)
    {
        $request->validate([
            'matricule' => ['required', 'string', 'max:255', 'unique:autocars,matricule,' . $autocar->id],
            'capacite' => ['required', 'integer', 'min:1'],
            'type' => ['required', 'in:local,external'],
            'societe_id' => ['required', 'exists:societes,id'],
            'equipements' => ['array'],
            'equipements.*' => ['exists:equipements,id'],
            'options' => ['array'],
            'options.*' => ['exists:options,id'],
        ]);

        $autocar->update($request->only('matricule', 'capacite', 'type', 'societe_id'));
        $autocar->equipements()->sync($request->input('equipements', []));
        $autocar->options()->sync($request->input('options', []));

        return redirect()->route('admin.autocars.index')->with('success', 'Autocar mis à jour.');
    }

    public function destroy(Autocar $autocar)
    {
        $autocar->delete();

        return redirect()->route('admin.autocars.index')->with('success', 'Autocar supprimé.');
    }
}
