<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_department()
    {
        $payload = [
            'name' => 'HR',
            'status' => 'active',
        ];

        $response = $this->postJson('/api/departments', $payload);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Department created successfully',
                     'data' => ['name' => 'HR', 'status' => 'active']
                 ]);

        $this->assertDatabaseHas('departments', ['name' => 'HR']);
    }

    /** @test */
    public function it_can_update_a_department()
    {
        $department = Department::factory()->create();

        $payload = ['name' => 'Finance', 'status' => 'inactive'];

        $response = $this->putJson("/api/departments/{$department->id}", $payload);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Department updated successfully']);

        $this->assertDatabaseHas('departments', ['name' => 'Finance']);
    }

    /** @test */
    public function it_can_delete_a_department()
    {
        $department = Department::factory()->create();

        $response = $this->deleteJson("/api/departments/{$department->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Department deleted successfully']);

        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }

    /** @test */
    public function it_can_list_departments()
    {
        Department::factory()->count(3)->create();

        $response = $this->getJson('/api/departments');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }
}
