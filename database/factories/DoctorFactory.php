<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\DoctorDetailLink;

class DoctorFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // You can change this to generate random passwords
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'address' => $this->faker->address,
            'role' => 'doctor',
            'phone_number' => $this->faker->numerify('##########'), // Generates a random 10-digit phone number
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            DoctorDetailLink::factory()->create([
                'doctor_id' => $user->id,
                'education' => $this->faker->sentence,
                'specialist_id' => 1, // Replace with the actual specialist ID
                'department_id' => 1, // Replace with the actual department ID
            ]);
        });
    }
}
