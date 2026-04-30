<?php

namespace App\Http\Requests\Admin;

use App\Models\Holiday;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertHolidayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Holiday|null $holiday */
        $holiday = $this->route('holiday');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('holidays', 'name')->ignore($holiday)],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }
}
