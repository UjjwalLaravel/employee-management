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
            'status' => 'required|in:active,inactive'
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status must be either active or inactive.'
        ];
    }
}
