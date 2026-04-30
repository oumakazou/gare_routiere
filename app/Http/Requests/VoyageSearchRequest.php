<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class VoyageSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ville_depart_id' => ['nullable', 'exists:villes,id', 'different:ville_arrivee_id'],
            'ville_arrivee_id' => ['nullable', 'exists:villes,id', 'different:ville_depart_id'],
            'date' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'date' => $this->input('date', Carbon::now()->addDay()->toDateString()),
        ]);
    }
}
