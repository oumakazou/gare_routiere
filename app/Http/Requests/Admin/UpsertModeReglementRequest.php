<?php

namespace App\Http\Requests\Admin;

use App\Models\ModeReglement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertModeReglementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var ModeReglement|null $modeReglement */
        $modeReglement = $this->route('mode_reglement');

        return [
            'nom' => ['required', 'string', 'max:255', Rule::unique('mode_reglements', 'nom')->ignore($modeReglement)],
        ];
    }
}
