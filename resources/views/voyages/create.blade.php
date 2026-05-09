@extends('layouts.app')

@section('title', 'Ajouter un voyage')

@section('content')
<div class="space-y-6">
    @include('components.flash')

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-600">Nouveau voyage</p>
        <h1 class="mt-2 text-3xl font-bold text-slate-900">Créer un voyage</h1>
        <p class="mt-2 text-slate-600">Renseignez les informations essentielles du trajet.</p>
    </div>

    @include('voyages.partials.form', [
        'voyage' => $voyage,
        'villeDepart' => $villeDepart,
        'villesArrivee' => $villesArrivee,
        'action' => route('voyages.store'),
        'method' => 'POST',
        'submitLabel' => 'Créer le voyage',
    ])
</div>
@endsection
