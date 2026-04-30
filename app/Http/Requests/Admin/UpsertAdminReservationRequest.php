<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertAdminReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'voyage_id' => ['required', 'exists:voyages,id'],
            'mode_reglement_id' => ['required', 'exists:mode_reglements,id'],
            'date_reservation' => ['required', 'date', 'after_or_equal:today'],
            'seat_numbers' => ['required', 'array', 'min:1'],
            'seat_numbers.*' => ['integer', 'min:1'],
            'status' => ['required', Rule::in(['confirmee', 'en_attente', 'annulee'])],
        ];
    }
}
