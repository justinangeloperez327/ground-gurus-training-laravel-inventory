<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequisitionRequest extends FormRequest
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
            'requisition_date' => ['required', 'date'],
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'integer'],
            'items.*.quantity' => ['required', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'requisition_date.required' => 'The requisition date field is required.',
            'items.*.id.required' => 'The item field is required.',
            'items.*.quantity.required' => 'The quantity field is required.',
        ];
    }
}
