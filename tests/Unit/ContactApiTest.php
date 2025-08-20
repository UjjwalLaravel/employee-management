<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_contact_for_employee()
    {
        $employee = Employee::factory()->create();

        $payload = [
            'phone_number' => '9876543210',
            'type' => 'mobile'
        ];

        $response = $this->postJson("/api/employees/{$employee->id}/contacts", $payload);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Contact created successfully']);

        $this->assertDatabaseHas('contacts', ['phone_number' => '9876543210']);
    }

    /** @test */
    public function it_can_update_contact_for_employee()
    {
        $employee = Employee::factory()->create();
        $contact = Contact::factory()->create(['employee_id' => $employee->id]);

        $payload = ['phone_number' => '1234567890'];

        $response = $this->putJson("/api/contacts/{$contact->id}", $payload);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Contact updated successfully']);

        $this->assertDatabaseHas('contacts', ['phone_number' => '1234567890']);
    }

    /** @test */
    public function it_can_delete_contact_for_employee()
    {
        $employee = Employee::factory()->create();
        $contact = Contact::factory()->create(['employee_id' => $employee->id]);

        $response = $this->deleteJson("/api/contacts/{$contact->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Contact deleted successfully']);

        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    /** @test */
    public function it_can_list_all_contacts_of_employee()
    {
        $employee = Employee::factory()->create();
        Contact::factory()->count(3)->create(['employee_id' => $employee->id]);

        $response = $this->getJson("/api/employees/{$employee->id}/contacts");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }
}
