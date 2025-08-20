<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_employee_with_addresses_and_contacts()
    {
        $department = Department::factory()->create();

        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'department_id' => $department->id,
            'status' => 'active',
            'addresses' => [
                [
                    'address_line1' => '123 Street',
                    'state' => 'NY',
                    'country' => 'USA',
                    'pin_code' => '10001',
                    'type' => 'home',
                ]
            ],
            'contacts' => [
                ['phone_number' => '9876543210', 'type' => 'mobile']
            ]
        ];

        $response = $this->postJson('/api/employees', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                    'success' => true,
                    'message' => 'Employee created successfully.'
                ]);

        $this->assertDatabaseHas('employees', ['email' => 'john@example.com']);
        $this->assertDatabaseHas('addresses', ['address_line1' => '123 Street']);
        $this->assertDatabaseHas('contacts', ['phone_number' => '9876543210']);
    }
}
