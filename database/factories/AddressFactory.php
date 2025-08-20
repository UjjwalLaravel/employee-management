<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'address_line1' => $this->faker->streetAddress,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'pin_code' => $this->faker->postcode,
            'type' => $this->faker->randomElement(['home', 'office']),
        ];
    }
}
