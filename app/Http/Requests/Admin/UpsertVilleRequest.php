<?php

namespace App\Http\Requests\Admin;

use App\Models\Ville;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertVilleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Ville|null $ville */
        $ville = $this->route('ville');

        return [
            'nom' => ['required', 'string', 'max:255', Rule::unique('villes', 'nom')->ignore($ville)],
        ];
    }
}
