<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_address_for_employee()
    {
        $employee = Employee::factory()->create();

        $payload = [
            'address_line1' => '123 Street',
            'address_line2' => 'Suite 1',
            'state' => 'NY',
            'country' => 'USA',
            'pin_code' => '10001',
            'type' => 'home'
        ];

        $response = $this->postJson("/api/employees/{$employee->id}/addresses", $payload);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Address created successfully']);

        $this->assertDatabaseHas('addresses', ['address_line1' => '123 Street']);
    }

    public function test_it_can_update_address_for_employee()
    {
        $employee = Employee::factory()->create();
        $address = Address::factory()->create(['employee_id' => $employee->id]);

        $payload = ['address_line1' => '456 New Street'];

        $response = $this->putJson("/api/addresses/{$address->id}", $payload);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Address updated successfully']);

        $this->assertDatabaseHas('addresses', ['address_line1' => '456 New Street']);
    }

    public function test_it_can_delete_address_for_employee()
    {
        $employee = Employee::factory()->create();
        $address = Address::factory()->create(['employee_id' => $employee->id]);

        $response = $this->deleteJson("/api/addresses/{$address->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Address deleted successfully']);

        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }

    public function test_it_can_list_all_addresses_of_employee()
    {
        $employee = Employee::factory()->create();
        Address::factory()->count(3)->create(['employee_id' => $employee->id]);

        $response = $this->getJson("/api/employees/{$employee->id}/addresses");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }
}
