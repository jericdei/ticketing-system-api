<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            UserPositionSeeder::class,
            AdminSeeder::class,
            TicketRelationshipSeeder::class
        ]);

        // For testing
        \App\Models\Users\User::factory(100)->create()->each(function($user) {
            $user->assignRole(\Spatie\Permission\Models\Role::inRandomOrder()->first()->name);
        });
        \App\Models\Tickets\Ticket::factory(100)->create();
        \App\Models\Tickets\Replies\Reply::factory(200)->create();
        \App\Models\Tickets\File::factory(50)->create();
        \App\Models\Tickets\Replies\File::factory(50)->create();
    }
}
