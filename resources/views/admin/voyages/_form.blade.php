@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="transport_company_id" class="mb-1 block text-sm font-semibold text-slate-700">Société de transport</label>
        <select id="transport_company_id" name="transport_company_id" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
            <option value="">-- Aucune --</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" @selected(old('transport_company_id', $voyage->transport_company_id) == $company->id)>{{ $company->name }}</option>
            @endforeach
        </select>
        @error('transport_company_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="created_by_name" class="mb-1 block text-sm font-semibold text-slate-700">Créé par</label>
        <input id="created_by_name" name="created_by_name" value="{{ old('created_by_name', $voyage->created_by_name) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
        @error('created_by_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div>
    <label for="line_name" class="mb-1 block text-sm font-semibold text-slate-700">Ligne de voyage</label>
    <input id="line_name" name="line_name" value="{{ old('line_name', $voyage->line_name ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
    @error('line_name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="destination" class="mb-1 block text-sm font-semibold text-slate-700">Destination</label>
    <input id="destination" name="destination" value="{{ old('destination', $voyage->destination ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
    @error('destination')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="grid gap-4 md:grid-cols-4">
    <div>
        <label for="travel_date" class="mb-1 block text-sm font-semibold text-slate-700">Date</label>
        <input id="travel_date" type="date" name="travel_date" value="{{ old('travel_date', $voyage->travel_date?->format('Y-m-d')) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
        @error('travel_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="departure_time" class="mb-1 block text-sm font-semibold text-slate-700">Heure départ</label>
        <input id="departure_time" type="time" name="departure_time" value="{{ old('departure_time', $voyage->departure_time) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
        @error('departure_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="tickets" class="mb-1 block text-sm font-semibold text-slate-700">Nb tickets</label>
        <input id="tickets" type="number" min="0" name="tickets" value="{{ old('tickets', $voyage->tickets ?? 0) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
        @error('tickets')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="total_ttc" class="mb-1 block text-sm font-semibold text-slate-700">Total TTC (MAD)</label>
        <input id="total_ttc" type="number" min="0" step="0.01" name="total_ttc" value="{{ old('total_ttc', $voyage->total_ttc ?? 0) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
        @error('total_ttc')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div>
    <label for="observations" class="mb-1 block text-sm font-semibold text-slate-700">Observations</label>
    <textarea id="observations" name="observations" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">{{ old('observations', $voyage->observations) }}</textarea>
    @error('observations')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="grid gap-4 md:grid-cols-2">
    <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="is_blocked" value="1" @checked(old('is_blocked', $voyage->is_blocked))>
        <span class="text-sm font-semibold text-slate-700">Voyage bloqué</span>
    </label>
    <div>
        <label for="blocked_by" class="mb-1 block text-sm font-semibold text-slate-700">Bloqué par</label>
        <input id="blocked_by" name="blocked_by" value="{{ old('blocked_by', $voyage->blocked_by) }}" class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-red-500 focus:ring-2 focus:ring-red-100">
        @error('blocked_by')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex gap-3 pt-2">
    <a href="{{ route('admin.voyages.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50">Annuler</a>
    <button type="submit" class="rounded-xl bg-red-600 px-5 py-3 font-semibold text-white hover:bg-red-700">{{ $buttonLabel }}</button>
</div>
