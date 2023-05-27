<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFootballPitchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'time_start' => 'string|required',
            'time_end' => 'required|string',
            'description' => 'nullable|string',
            'price_per_hour' => 'required|numeric',
            'price_per_peak_hour' => 'required|numeric',
            'pitch_type_id' => 'required|numeric',
            'from_football_pitch_id' => 'nullable|numeric',
            'to_football_pitch_id' => 'nullable|numeric',
        ];
    }
}
