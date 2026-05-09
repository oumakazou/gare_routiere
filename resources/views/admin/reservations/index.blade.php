@extends('layouts.admin')

@section('title', 'Admin Reservations')

@section('content')
<div class="space-y-5">
    <h1 class="text-3xl font-bold">Reservations</h1>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Client</th>
                    <th class="px-4 py-3 text-left font-semibold">Telephone</th>
                    <th class="px-4 py-3 text-left font-semibold">Voyage</th>
                    <th class="px-4 py-3 text-left font-semibold">Date creation</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($reservations as $reservation)
                    <tr>
                        <td class="px-4 py-3">{{ $reservation->client_name }}</td>
                        <td class="px-4 py-3">{{ $reservation->client_phone }}</td>
                        <td class="px-4 py-3">Taza → {{ $reservation->voyage->destination ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $reservation->created_at?->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-slate-500">Aucune reservation.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
        {{ $reservations->links() }}
    </div>
</div>
@endsection
