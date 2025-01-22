<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => ['required', 'regex:/^(0|\+84)(3[2-9]|5[2689]|7[0-9]|8[1-9]|9[0-9])[0-9]{7}$/'],
            'email' => 'required|email',
            'department_id' => 'required|exists:departments,id',
            'title' => 'required',
            'reception_time' => 'required|date_format:Y-m-d\TH:i|after_or_equal:today',
            'support_request' => 'required'
        ];
    }
}
