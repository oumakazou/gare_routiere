<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpsertVoyageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ville_depart_id' => ['required', 'exists:villes,id', 'different:ville_arrivee_id'],
            'ville_arrivee_id' => ['required', 'exists:villes,id', 'different:ville_depart_id'],
            'autocar_id' => ['required', 'exists:autocars,id'],
            'type_voyage_id' => ['required', 'exists:type_voyages,id'],
            'heure_depart' => ['required', 'date_format:H:i'],
            'heure_arrivee' => ['required', 'date_format:H:i', 'different:heure_depart'],
            'base_price' => ['required', 'numeric', 'min:1'],
            'is_special' => ['nullable', 'boolean'],
        ];
    }
}
