<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditAccountRequest extends FormRequest
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
        $id = Auth::guard('customers')->user()->id;
        return [
            'name' => 'required|min:2',
            'phone' => ['required', "unique:customers,phone,$id", 'regex:/^(0|\+84)(3[2-9]|5[2689]|7[0-9]|8[1-9]|9[0-9])[0-9]{7}$/'],
        ];
    }
}
