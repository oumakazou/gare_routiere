<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoyageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ville_arrivee_id' => ['required', 'exists:villes,id'],
            'date_depart' => ['required', 'date'],
            'heure_depart' => ['required', 'date_format:H:i'],
            'heure_arrivee' => ['required', 'date_format:H:i', 'after:heure_depart'],
            'price' => ['required', 'numeric', 'min:0'],
            'available_seats' => ['required', 'integer', 'min:1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'ville_arrivee_id' => "ville d'arrivée",
            'date_depart' => 'date de départ',
            'heure_depart' => 'heure de départ',
            'heure_arrivee' => "heure d'arrivée",
            'price' => 'prix',
            'available_seats' => 'places disponibles',
        ];
    }
}
