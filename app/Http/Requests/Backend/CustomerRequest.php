<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $customerId = $this->route('customer');
        return [
            'name' => 'required|string|min:2',
            'phone' => $customerId ?  [
                'nullable',
                "unique:customers,phone,$customerId",
                'regex:/^(0|\+84)(3[2-9]|5[2689]|7[0-9]|8[1-9]|9[0-9])[0-9]{7}$/'
            ] :  [
                'nullable',
                "unique:customers,phone",
                'regex:/^(0|\+84)(3[2-9]|5[2689]|7[0-9]|8[1-9]|9[0-9])[0-9]{7}$/'
            ],
            'email' => $customerId
                ? "required|email|unique:customers,email,$customerId"
                : 'required|email|unique:customers,email',
            'status' => 'integer|required',
            'password' => 'nullable|min:5|confirmed'
        ];
    }
}
