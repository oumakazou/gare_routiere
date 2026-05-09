@extends('layouts.admin')

@section('title', 'Modifier voyage')

@section('content')
<div class="max-w-3xl space-y-5">
    <h1 class="text-3xl font-bold">Modifier voyage</h1>
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.voyages.update', $voyage) }}" class="space-y-4">
            @method('PUT')
            @php($buttonLabel = 'Mettre a jour')
            @include('admin.voyages._form', ['voyage' => $voyage])
        </form>
    </div>
</div>
@endsection
