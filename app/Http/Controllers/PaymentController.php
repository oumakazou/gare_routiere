<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create(Reservation $reservation)
    {
        // Ensure user owns the reservation
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow payment for pending reservations
        if ($reservation->payment_status !== 'pending') {
            return redirect()->route('reservations.index')->with('error', 'Cette réservation ne nécessite pas de paiement.');
        }

        return view('payments.create', compact('reservation'));
    }

    public function store(Request $request, Reservation $reservation)
    {
        // Ensure user owns the reservation
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_method' => 'required|in:card,bank_transfer',
            'card_number' => 'required_if:payment_method,card|string|size:16',
            'expiry_date' => 'required_if:payment_method,card|string|regex:/^\d{2}\/\d{2}$/',
            'cvv' => 'required_if:payment_method,card|string|size:3',
        ]);

        // Simulate payment processing
        // In production, integrate with Stripe or other payment gateway
        $paymentSuccessful = $this->processPayment($request->all());

        if ($paymentSuccessful) {
            $reservation->update([
                'payment_status' => 'paid',
                'status' => 'confirmee'
            ]);

            return redirect()->route('payments.success')->with('success', 'Paiement effectué avec succès!');
        } else {
            return back()->with('error', 'Échec du paiement. Veuillez réessayer.');
        }
    }

    public function success()
    {
        return view('payments.success');
    }

    private function processPayment(array $data): bool
    {
        // Simulate payment processing
        // In production, use Stripe API or similar
        return true; // Always succeed for demo
    }
}