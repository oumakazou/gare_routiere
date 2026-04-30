<?php

namespace App\Http\Requests\Admin;

use App\Models\Equipement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertEquipementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Equipement|null $equipement */
        $equipement = $this->route('equipement');

        return [
            'nom' => ['required', 'string', 'max:255', Rule::unique('equipements', 'nom')->ignore($equipement)],
        ];
    }
}
