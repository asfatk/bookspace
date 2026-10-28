<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'buku.view',
            'buku.create',
            'buku.update',
            'buku.delete',
            'role.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $dosen = Role::firstOrCreate([
            'name' => 'Dosen',
            'guard_name' => 'web',
        ]);

        $mahasiswa = Role::firstOrCreate([
            'name' => 'Mahasiswa',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions($permissions);

        $dosen->syncPermissions([
            'buku.view',
            'buku.create',
            'buku.update',
        ]);

        $mahasiswa->syncPermissions([
            'buku.view',
        ]);

        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@bookspace.test',
                'role' => 'Admin',
            ],
            [
                'name' => 'Dosen BookSpace',
                'email' => 'dosen@bookspace.test',
                'role' => 'Dosen',
            ],
            [
                'name' => 'Mahasiswa BookSpace',
                'email' => 'mahasiswa@bookspace.test',
                'role' => 'Mahasiswa',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('Password123!'),
                ]
            );

            $user->syncRoles([$data['role']]);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
