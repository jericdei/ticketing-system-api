<?php

namespace Database\Factories\Tickets;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tickets\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(mt_rand(5,20)),
            'path' => fake()->filePath(),
            'ticket_id' => \App\Models\Tickets\Ticket::inRandomOrder()->first()->id
        ];
    }
}
