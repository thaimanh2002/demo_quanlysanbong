<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderClientStoreRequest extends FormRequest
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
            'start_at' => 'required|string',
            'end_at' => 'required|string',
            'football_pitch_id' => 'required|exists:football_pitches,id',
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'nullable|email',
        ];
    }

    public function messages(): array
    {
        return [
            'start_at.required' => 'Thời gian bắt đầu không được để trống',
            'end_at.required' => 'Thời gian kết thúc không được để trống',
            'football_pitch_id.required' => 'Sân liên kết không được để trống',
            'football_pitch_id.exists' => 'Sân liên kết không tồn tại',
            'name.required' => 'Tên không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'email.email' => 'Email không đúng định dạng',
        ];
    }
}
