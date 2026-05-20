@extends('layouts.app')

@section('title', 'Gestion des Demandes de Voyage - Admin')

@section('content')
@include('components.flash')

<section class="space-y-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Gestion des Demandes de Voyage</h1>
        <p class="mt-2 text-slate-600">Visualisez et gérez toutes les demandes de voyage soumises par les utilisateurs.</p>
    </div>

    @if($voyageRequests->count() > 0)
        <div class="grid gap-6">
            @foreach($voyageRequests as $request)
                <div class="rounded-3xl bg-white p-6 shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 ease-in-out">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <!-- Request Details -->
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h2 class="text-2xl font-bold text-slate-900">
                                    {{ $request->departure }}
                                    <span class="text-slate-500">→</span>
                                    {{ $request->arrivalVille->nom }}
                                </h2>
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-gray-100 text-gray-800',
                                        'accepted' => 'bg-neutral-100 text-neutral-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ][$request->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </div>
                            <p class="text-slate-600">
                                <span class="font-semibold">{{ $request->seats }}</span> sièges demandés
                            </p>
                            <p class="text-slate-600">
                                Prix total: <span class="font-semibold">{{ number_format($request->price, 2, ',', ' ') }} MAD</span>
                            </p>
                            <p class="text-sm text-slate-500 mt-1">
                                Demandé par: <span class="font-medium">{{ $request->user ? $request->user->name : 'Invité' }}</span> ({{ $request->created_at->format('d/m/Y H:i') }})
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row gap-2">
                            @if($request->status === 'pending')
                                <form action="{{ route('admin.voyage-requests.update-status', $request) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-neutral-600 px-4 py-2 text-white font-medium shadow-sm hover:bg-neutral-700 transition-all duration-200">
                                        Accepter
                                    </button>
                                </form>
                                <form action="{{ route('admin.voyage-requests.update-status', $request) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-red-600 px-4 py-2 text-white font-medium shadow-sm hover:bg-red-700 transition-all duration-200">
                                        Rejeter
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.voyage-requests.destroy', $request) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-slate-700 px-4 py-2 text-white font-medium shadow-sm hover:bg-slate-800 transition-all duration-200">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($voyageRequests->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $voyageRequests->links('pagination::tailwind') }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="rounded-3xl bg-white p-12 shadow-lg border border-slate-100 text-center">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-semibold text-slate-900">Aucune demande de voyage trouvée</h3>
            <p class="mt-2 text-slate-600">
                Il n'y a actuellement aucune demande de voyage en attente ou traitée.
            </p>
        </div>
    @endif
</section>
@endsection
