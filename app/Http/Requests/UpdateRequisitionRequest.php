<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequisitionRequest extends FormRequest
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
            'items.*.item_id' => ['required', 'integer', 'exists:items,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'string', 'in:pending,approved,rejected, cancelled'],
        ];
    }

    public function messages()
    {
        return [
            'requisition_date.required' => 'The requisition date field is required.',
            'items.*.item_id.required' => 'The item field is required.',
            'items.*.quantity.required' => 'The quantity field is required.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status field must be one of: pending, approved, rejected, cancelled',
        ];
    }
}
