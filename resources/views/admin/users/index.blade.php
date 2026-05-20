@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
<div class="space-y-5">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Utilisateurs</h1>
        <a href="{{ route('admin.users.create') }}" class="rounded-xl bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-700">+ Ajouter</a>
    </div>

    @if(session('success'))
        <div class="rounded-xl border border-neutral-200 bg-neutral-50 px-4 py-3 text-sm text-neutral-800">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Nom</th>
                    <th class="px-4 py-3 text-left font-semibold">Email</th>
                    <th class="px-4 py-3 text-left font-semibold">Rôle</th>
                    <th class="px-4 py-3 text-left font-semibold">Admin</th>
                    <th class="px-4 py-3 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-3">{{ $user->nom }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->role ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $user->is_admin ? 'Oui' : 'Non' }}</td>
                        <td class="px-4 py-3 flex flex-wrap items-center gap-3">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-red-600 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">Aucun utilisateur.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
        {{ $users->links() }}
    </div>
</div>
@endsection
