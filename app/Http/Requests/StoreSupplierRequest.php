<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The Supplier Name is Required',
            'email.required' => 'The Supplier Email is Required',
            'email.email' => 'The Email must be valid',
            'phone.required' => 'The Supplier Phone is Required',
        ];
    }
}
