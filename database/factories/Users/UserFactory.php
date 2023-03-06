<?php

namespace Database\Factories\Users;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users\User>
 */
class UserFactory extends Factory
{
    protected $model = \App\Models\Users\User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'), // password
            'company_name' => fake()->company(),
            'company_address' => fake()->address(),
            'remember_token' => Str::random(10),
            'position_id' => \App\Models\Users\Position::inRandomOrder()->first()->id,
            'department_id' => \App\Models\Common\Department::inRandomOrder()->first()->id,
            'email_verified_at' => now()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
