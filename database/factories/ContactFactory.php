<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'phone_number' => $this->faker->phoneNumber,
            'type' => $this->faker->randomElement(['mobile', 'landline']),
        ];
    }
}
