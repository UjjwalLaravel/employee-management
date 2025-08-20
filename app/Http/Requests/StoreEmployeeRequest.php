<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'department_id' => 'required|exists:departments,id',
        'status' => 'required|in:active,inactive',

        'addresses' => 'sometimes|array',
        'addresses.*.address_line1' => 'required|string|max:255',
        'addresses.*.address_line2' => 'nullable|string|max:255',
        'addresses.*.state' => 'required|string|max:100',
        'addresses.*.country' => 'required|string|max:100',
        'addresses.*.pin_code' => 'required|string|max:20',

        'contacts' => 'sometimes|array',
        'contacts.*.phone_number' => 'required|string|max:15'
    ];
}

public function messages(): array
{
    return [
        'status.in' => 'Status must be either active or inactive.'
    ];
}
}
