<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            'Project Manager', 'QA Specialist', 'Junior Web Developer',
            'Intermediate Web Developer', 'Mid-level Web Developer',
            'Senior Web Developer', 'Marketing Staff', 'Junior Designer',
            'Senior Designer', 'SEO Specialist', 'Marketing Account Manager',
            'Head of Sales and Marketing', 'Marketing Lead Generator'
        ];

        foreach ($positions as $position) {
            \App\Models\Users\Position::create([
                'name' => $position
            ]);
        }
    }
}
