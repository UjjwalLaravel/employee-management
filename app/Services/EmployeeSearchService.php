<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeSearchService
{
    public function search(array $filters)
    {
        $query = Employee::with(['department', 'addresses', 'contacts']);

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (!empty($filters['phone'])) {
            $query->whereHas('contacts', function ($q) use ($filters) {
                $q->where('phone_number', 'like', '%' . $filters['phone'] . '%');
            });
        }

        if (!empty($filters['department'])) {
            $query->whereHas('department', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['department'] . '%');
            });
        }

        return $query->get();
    }
}
