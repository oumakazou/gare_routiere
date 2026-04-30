<?php

namespace App\Http\Requests\Admin;

use App\Models\Societe;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertSocieteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Societe|null $societe */
        $societe = $this->route('societe');

        return [
            'nom' => ['required', 'string', 'max:255', Rule::unique('societes', 'nom')->ignore($societe)],
            'contact' => ['nullable', 'string', 'max:255'],
        ];
    }
}
