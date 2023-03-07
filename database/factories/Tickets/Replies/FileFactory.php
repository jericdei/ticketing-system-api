<?php

namespace Database\Factories\Tickets\Replies;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tickets\Reply\File>
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
            'ticket_reply_id' => \App\Models\Tickets\Replies\Reply::inRandomOrder()->first()->id
        ];
    }
}
