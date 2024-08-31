<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'order_date' => ['required', 'date'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'items' => ['required', 'array'],
            'items.*.item_id' => ['required', 'integer', 'exists:items,id'],
            'items.*.quantity' => ['required', 'integer'],
            'items.*.price' => ['required', 'numeric'],
            'status' => ['required', 'string', 'in:pending,approved,rejected, cancelled'],
        ];
    }

    public function messages()
    {
        return [
            'requisition_date.required' => 'The requisition date field is required.',
            'supplier_id.required' => 'The supplier field is required.',
            'items.*.item_id.required' => 'The item field is required.',
            'items.*.quantity.required' => 'The quantity field is required.',
            'items.*.price.required' => 'The price field is required.',
            'status.in' => 'The status field must be one of: pending, approved, rejected, cancelled',
        ];
    }
}
