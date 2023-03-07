<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TicketRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketTypes = [
            'Support', 'Technical Support (Hardware)', 'Retainer',
            'Enhancement', 'Operations'
        ];

        $ticketStatuses = [
            'Open', 'Closed', 'For User Validation',
            'Ongoing', 'Done', 'Re-open', 'User Replied'
        ];

        $ticketPriorities = [
            'Low', 'Medium', 'High'
        ];

        $ticketConcernTypes = [
            'Complain', 'Inquiry', 'Request', 'Untagged'
        ];

        foreach ($ticketTypes as $value) {
            \App\Models\Tickets\Type::create([
                'name' => $value
            ]);
        }

        foreach ($ticketStatuses as $value) {
            \App\Models\Tickets\Status::create([
                'name' => $value
            ]);
        }

        foreach ($ticketPriorities as $value) {
            \App\Models\Tickets\Priority::create([
                'name' => $value
            ]);
        }

        foreach ($ticketConcernTypes as $value) {
            \App\Models\Tickets\Concern::create([
                'name' => $value
            ]);
        }
    }
}
