<?php

namespace Database\Factories\Tickets\Replies;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tickets\TicketReply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message' => fake()->paragraph(),
            'ticket_id' => \App\Models\Tickets\Ticket::inRandomOrder()->first()->id,
            'user_id' => \App\Models\Users\User::inRandomOrder()->first()->id
        ];
    }
}
