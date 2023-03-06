<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $userPermissions = ['add user', 'edit user', 'view user', 'delete user'];
        $rolePermissions = ['add role', 'edit role', 'view role', 'delete role'];
        $ticketPermissions = ['add ticket', 'edit ticket', 'view ticket', 'delete ticket'];
        $allPermissions = array_merge($userPermissions, $rolePermissions, $ticketPermissions);

        foreach ($allPermissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        Role::create(['name' => 'Admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Department Admin'])->givePermissionTo(array_merge($ticketPermissions, $userPermissions));
        Role::create(['name' => 'User'])->givePermissionTo($ticketPermissions);

        $admin = \App\Models\Users\User::create([
            'first_name' => 'Lhoopa',
            'middle_name' => NULL,
            'last_name' => 'Admin',
            'username' => 'lhoopa.admin',
            'email' => 'admin.lhoopa@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('adminlhoopa2023'),
            'company_name' => 'Lhoopa Inc.',
            'company_address' => 'Unit 3701 One Corporate Centre, Julia Vargas corner, 1605 Meralco Ave, Ortigas Center, Pasig, Metro Manila',
            'position_id' => 3,
            'department_id' => 1,
        ]);

        $admin->assignRole('Admin');
    }
}
