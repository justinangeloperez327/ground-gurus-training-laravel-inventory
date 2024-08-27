<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSupplierRequest extends FormRequest
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
            'phone' => ['required', 'regex:/^(\+63|0)9\d{9}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The supplier name is required',
            'email.required' => 'The supplier email is required',
            'email.email' => 'The email must be valid',
            'phone.required' => 'The supplier phone is required',
            'phone.regex' => 'The phone number must be a valid PH number',
        ];
    }
}
