<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportCompany;
use App\Models\Voyage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VoyageController extends Controller
{
    public function index(Request $request): View
    {
        $voyages = Voyage::query()
            ->with('transportCompany')
            ->when($request->filled('destination'), function ($query) use ($request) {
                $query->where('destination', 'like', '%' . trim((string) $request->destination) . '%');
            })
            ->when($request->filled('travel_date'), function ($query) use ($request) {
                $query->whereDate('travel_date', $request->travel_date);
            })
            ->when($request->filled('company_id'), function ($query) use ($request) {
                $query->where('transport_company_id', $request->integer('company_id'));
            })
            ->when($request->filled('is_blocked'), function ($query) use ($request) {
                $query->where('is_blocked', $request->is_blocked === '1');
            })
            ->orderBy('travel_date')
            ->orderBy('departure_time')
            ->paginate(15)
            ->withQueryString();

        $companies = TransportCompany::query()->orderBy('name')->get();

        return view('admin.voyages.index', compact('voyages', 'companies'));
    }

    public function create(): View
    {
        return view('admin.voyages.create', [
            'voyage' => new Voyage(),
            'companies' => TransportCompany::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'transport_company_id' => ['nullable', 'exists:transport_companies,id'],
            'line_name' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'travel_date' => ['required', 'date'],
            'departure_time' => ['nullable', 'date_format:H:i'],
            'tickets' => ['required', 'integer', 'min:0'],
            'total_ttc' => ['required', 'numeric', 'min:0'],
            'observations' => ['nullable', 'string'],
            'is_blocked' => ['nullable', 'boolean'],
            'blocked_by' => ['nullable', 'string', 'max:255'],
            'created_by_name' => ['nullable', 'string', 'max:255'],
        ]);

        Voyage::create([
            ...$data,
            'is_blocked' => (bool) ($data['is_blocked'] ?? false),
            'ville_depart' => 'Taza',
            'ville_arrivee' => $data['destination'],
            'date_voyage' => $data['travel_date'],
            'prix' => $data['total_ttc'],
            'places_disponibles' => $data['tickets'],
        ]);

        return redirect()
            ->route('admin.voyages.index')
            ->with('success', 'Voyage cree avec succes.');
    }

    public function edit(Voyage $voyage): View
    {
        return view('admin.voyages.edit', [
            'voyage' => $voyage,
            'companies' => TransportCompany::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Voyage $voyage): RedirectResponse
    {
        $data = $request->validate([
            'transport_company_id' => ['nullable', 'exists:transport_companies,id'],
            'line_name' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'travel_date' => ['required', 'date'],
            'departure_time' => ['nullable', 'date_format:H:i'],
            'tickets' => ['required', 'integer', 'min:0'],
            'total_ttc' => ['required', 'numeric', 'min:0'],
            'observations' => ['nullable', 'string'],
            'is_blocked' => ['nullable', 'boolean'],
            'blocked_by' => ['nullable', 'string', 'max:255'],
            'created_by_name' => ['nullable', 'string', 'max:255'],
        ]);

        $voyage->update([
            ...$data,
            'is_blocked' => (bool) ($data['is_blocked'] ?? false),
            'ville_depart' => 'Taza',
            'ville_arrivee' => $data['destination'],
            'date_voyage' => $data['travel_date'],
            'prix' => $data['total_ttc'],
            'places_disponibles' => $data['tickets'],
        ]);

        return redirect()
            ->route('admin.voyages.index')
            ->with('success', 'Voyage mis a jour.');
    }

    public function destroy(Voyage $voyage): RedirectResponse
    {
        $voyage->delete();

        return redirect()
            ->route('admin.voyages.index')
            ->with('success', 'Voyage supprime.');
    }
}
