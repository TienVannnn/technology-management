<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
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
            'support_request' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'department_id' => 'required|exists:departments,id',
            'status' => 'required|in:-1,0,1',
            'reception_time' => 'required|date_format:Y-m-d\TH:i|after_or_equal:today'
        ];
    }
}
