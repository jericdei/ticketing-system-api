<?php

namespace Database\Factories\Tickets;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tickets\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = \App\Models\Tickets\Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\Users\User::inRandomOrder()->first();

        return [
            'ticket_code' => fake()->unique()->regexify('[A-Za-z0-9]{8}'),
            'subject' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'is_follow_up' => mt_rand(0, 1),
            'client_name' => fake()->name(),
            'client_email' => fake()->email(),
            'client_phone' => fake()->phoneNumber(),
            'with_email' => mt_rand(0, 1),
            'user_id' => $user->id,
            'department_id' => $user->department_id,
            'type_id' => \App\Models\Tickets\Type::inRandomOrder()->first()->id,
            'status_id' => \App\Models\Tickets\Status::inRandomOrder()->first()->id,
            'priority_id' => \App\Models\Tickets\Priority::inRandomOrder()->first()->id,
            'concern_id' => \App\Models\Tickets\Concern::inRandomOrder()->first()->id,
            'status_updated_at' => mt_rand(0, 1) ? Carbon::now()->subDays(rand(1,30))->addSeconds(rand(0, 86400))->format('Y-m-d H:i:s') : null,
            'resolved_at' => mt_rand(0, 1) ? Carbon::now()->subDays(rand(1,30))->addSeconds(rand(0, 86400))->format('Y-m-d H:i:s') : null
        ];
    }
}
