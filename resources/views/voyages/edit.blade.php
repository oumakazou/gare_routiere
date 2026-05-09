@extends('layouts.app')

@section('title', 'Modifier un voyage')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-600">Mise à jour</p>
        <h1 class="mt-2 text-3xl font-bold text-slate-900">Modifier le voyage</h1>
        <p class="mt-2 text-slate-600">Ajustez les informations du trajet sans perdre l’historique du voyage.</p>
    </div>

    @include('voyages.partials.form', [
        'voyage' => $voyage,
        'villeDepart' => $villeDepart,
        'villesArrivee' => $villesArrivee,
        'action' => route('voyages.update', $voyage),
        'method' => 'PUT',
        'submitLabel' => 'Enregistrer les modifications',
    ])
</div>
@endsection
