<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function create(Reservation $reservation): View|RedirectResponse
    {
        if (! $this->belongsToCurrentSession($reservation)) {
            return redirect()
                ->route('reservations.index')
                ->with('error', 'Cette reservation n est pas disponible dans votre session.');
        }

        if ($this->isPaid($reservation)) {
            return redirect()
                ->route('payments.success', $reservation)
                ->with('success', 'Cette reservation est deja marquee comme payee.');
        }

        $reservation->load('voyage');

        return view('payments.create', compact('reservation'));
    }

    public function store(Request $request, Reservation $reservation): RedirectResponse
    {
        if (! $this->belongsToCurrentSession($reservation)) {
            return redirect()
                ->route('reservations.index')
                ->with('error', 'Cette reservation n est pas disponible dans votre session.');
        }

        $validated = $request->validate([
            'payment_method' => ['required', 'in:card,bank_transfer'],
            'card_number' => ['required_if:payment_method,card', 'nullable', 'string', 'regex:/^[0-9 ]{13,19}$/'],
            'expiry_date' => ['required_if:payment_method,card', 'nullable', 'string', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => ['required_if:payment_method,card', 'nullable', 'string', 'regex:/^\d{3,4}$/'],
            'terms' => ['accepted'],
        ]);

        Log::info('Reservation payment registered', [
            'reservation_id' => $reservation->id,
            'payment_method' => $validated['payment_method'],
        ]);

        session([
            'paid_reservations' => collect(session('paid_reservations', []))
                ->prepend($reservation->id)
                ->unique()
                ->values()
                ->all(),
            'last_paid_reservation_id' => $reservation->id,
        ]);

        return redirect()
            ->route('payments.success', $reservation)
            ->with('success', 'Paiement enregistre avec succes.');
    }

    public function success(Reservation $reservation): View|RedirectResponse
    {
        if (! $this->belongsToCurrentSession($reservation)) {
            return redirect()
                ->route('reservations.index')
                ->with('error', 'Cette reservation n est pas disponible dans votre session.');
        }

        if (! $this->isPaid($reservation)) {
            return redirect()
                ->route('payments.create', $reservation)
                ->with('error', 'Veuillez finaliser le paiement avant d ouvrir cette page.');
        }

        $reservation->load('voyage');

        return view('payments.success', compact('reservation'));
    }

    private function belongsToCurrentSession(Reservation $reservation): bool
    {
        return in_array($reservation->id, session('reservation_history', []), true);
    }

    private function isPaid(Reservation $reservation): bool
    {
        return in_array($reservation->id, session('paid_reservations', []), true);
    }
}
