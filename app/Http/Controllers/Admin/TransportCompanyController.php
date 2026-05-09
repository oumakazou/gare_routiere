<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportCompany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransportCompanyController extends Controller
{
    public function index(): View
    {
        $companies = TransportCompany::query()->orderBy('name')->paginate(15);

        return view('admin.transport-companies.index', compact('companies'));
    }

    public function create(): View
    {
        return view('admin.transport-companies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:transport_companies,name'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        TransportCompany::create([
            'name' => $data['name'],
            'is_active' => (bool) ($data['is_active'] ?? true),
        ]);

        return redirect()->route('admin.transport-companies.index')->with('success', 'Societe ajoutee.');
    }

    public function edit(TransportCompany $transportCompany): View
    {
        return view('admin.transport-companies.edit', compact('transportCompany'));
    }

    public function update(Request $request, TransportCompany $transportCompany): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:transport_companies,name,' . $transportCompany->id],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $transportCompany->update([
            'name' => $data['name'],
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        return redirect()->route('admin.transport-companies.index')->with('success', 'Societe modifiee.');
    }

    public function destroy(TransportCompany $transportCompany): RedirectResponse
    {
        $transportCompany->delete();
        return redirect()->route('admin.transport-companies.index')->with('success', 'Societe supprimee.');
    }
}
