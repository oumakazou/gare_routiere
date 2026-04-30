<?php

namespace App\Http\Requests\Admin;

use App\Models\TypeVoyage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertTypeVoyageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var TypeVoyage|null $typeVoyage */
        $typeVoyage = $this->route('type_voyage');

        return [
            'nom' => ['required', 'string', 'max:255', Rule::unique('type_voyages', 'nom')->ignore($typeVoyage)],
        ];
    }
}
