<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Membuat permission
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'edit content']);
        Permission::create(['name' => 'view reports']);

        // Membuat role
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleGuru = Role::create(['name' => 'guru']);
        $roleSiswa = Role::create(['name' => 'siswa']);

        // Menetapkan permission ke role
        $roleAdmin->givePermissionTo(['manage users', 'edit content', 'view reports']);
        $roleGuru->givePermissionTo(['edit content']);
        $roleSiswa->givePermissionTo(['view reports']);

        // Menetapkan role ke pengguna
        // Contoh: Menetapkan role admin ke user dengan ID 1
        $user = \App\Models\User::find(1);
        $user->assignRole('admin');
    }
}
