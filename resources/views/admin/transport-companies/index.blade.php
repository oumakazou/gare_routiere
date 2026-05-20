@extends('layouts.admin')

@section('title', 'Sociétés de transport')

@section('content')
<div class="space-y-5">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Sociétés de transport</h1>
        <a href="{{ route('admin.transport-companies.create') }}" class="rounded-xl bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-700">+ Ajouter</a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Nom</th>
                    <th class="px-4 py-3 text-left font-semibold">Active</th>
                    <th class="px-4 py-3 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($companies as $company)
                    <tr>
                        <td class="px-4 py-3">{{ $company->name }}</td>
                        <td class="px-4 py-3">{{ $company->is_active ? 'Oui' : 'Non' }}</td>
                        <td class="px-4 py-3 flex items-center gap-3">
                            <a href="{{ route('admin.transport-companies.edit', $company) }}" class="text-red-600 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.transport-companies.destroy', $company) }}" onsubmit="return confirm('Supprimer ?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-4 py-6 text-center text-slate-500">Aucune société.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
        {{ $companies->links() }}
    </div>
</div>
@endsection
