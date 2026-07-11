<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view dashboard',
            'submit report',
            'view shelters',
            'manage reports',
            'validate reports',
            'publish alerts',
            'manage shelters',
            'view analytics',
            'manage users',
            'manage roles',
            'view audit logs',
            'manage emergency documents',
            'approve critical alerts',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $citizen = Role::firstOrCreate([
            'name' => 'Citizen',
            'guard_name' => 'web',
        ]);

        $responder = Role::firstOrCreate([
            'name' => 'Emergency Responder',
            'guard_name' => 'web',
        ]);

        $authority = Role::firstOrCreate([
            'name' => 'Authority Administrator',
            'guard_name' => 'web',
        ]);

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Administrator',
            'guard_name' => 'web',
        ]);

        $citizen->syncPermissions([
            'view dashboard',
            'submit report',
            'view shelters',
        ]);

        $responder->syncPermissions([
            'view dashboard',
            'view shelters',
            'manage reports',
        ]);

        $authority->syncPermissions([
            'view dashboard',
            'manage reports',
            'validate reports',
            'publish alerts',
            'manage shelters',
            'view analytics',
            'manage emergency documents',
            'approve critical alerts',
        ]);

        $superAdmin->syncPermissions($permissions);
    }
}