<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'IT', 'AM', 'Accounting', 'Construction', 'Sales',
            'Acquisition', 'Operations', 'HR', 'Admin', 'Customer Experience'
        ];

        foreach ($departments as $department) {
            \App\Models\Common\Department::create([
                'name' => $department
            ]);
        }
    }
}
