<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $cashierRole = Role::firstOrCreate(['name' => 'cashier']);

        $admin = User::create([
            'name' => 'admin',
            'username' => 'admin12',
            'password' => bcrypt('password'),
            'shift' => 'Tiap Hari ON',
            'images' => 'default.png',
            'status' => 'online'
        ]);
        $admin->assignRole($adminRole);

        $cashier = User::create([
            'name' => 'Guntur',
            'username' => 'cashier',
            'password' => bcrypt('password'),
            'shift' => 'siang',
            'images' => 'default.png'
        ]);
        $cashier->assignRole($cashierRole);




        // $permission = Permission::create(['name' => 'edit articles']);

        // $role->givePermissionTo($permission);
    }
}
