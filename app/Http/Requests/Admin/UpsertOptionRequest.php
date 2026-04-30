<?php

namespace App\Http\Requests\Admin;

use App\Models\Option;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Option|null $option */
        $option = $this->route('option');

        return [
            'nom' => ['required', 'string', 'max:255', Rule::unique('options', 'nom')->ignore($option)],
        ];
    }
}
