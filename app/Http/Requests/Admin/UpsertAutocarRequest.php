<?php

namespace App\Http\Requests\Admin;

use App\Models\Autocar;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertAutocarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Autocar|null $autocar */
        $autocar = $this->route('autocar');

        return [
            'matricule' => ['required', 'string', 'max:255', Rule::unique('autocars', 'matricule')->ignore($autocar)],
            'capacite' => ['required', 'integer', 'min:1', 'max:80'],
            'type' => ['required', Rule::in(['local', 'external'])],
            'societe_id' => ['required', 'exists:societes,id'],
            'equipements' => ['nullable', 'array'],
            'equipements.*' => ['exists:equipements,id'],
            'options' => ['nullable', 'array'],
            'options.*' => ['exists:options,id'],
        ];
    }
}
