@extends('layouts.admin')

@section('title', 'Nouveau voyage')

@section('content')
<div class="max-w-3xl space-y-5">
    <div>
        <h1 class="text-3xl font-bold">Nouveau voyage</h1>
        <p class="mt-2 text-sm text-slate-500">Creez un depart disponible a la reservation depuis l'espace admin.</p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.voyages.store') }}" class="space-y-4">
            @php($buttonLabel = 'Creer le voyage')
            @include('admin.voyages._form', ['voyage' => $voyage])
        </form>
    </div>
</div>
@endsection
