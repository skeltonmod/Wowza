<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::query()->create([
            'name' => 'Elijah Abgao',
            'first_name' => 'Elijah',
            'last_name' => 'Abgao',
            'email' => 'abgaoe@gmail.com',
            'password' => bcrypt('userpassword123'),
            'username' => 'skeltonmod',
            'address' => 'Cebu City',
            'phone' => '09123456789',
        ]);

        $user->assignRole('user');

        $cashier = User::query()->create([
            'name' => 'Junil Sapatan',
            'first_name' => 'Junil',
            'last_name' => 'Sapatan',
            'email' => 'junilbiot@gmail.com',
            'password' => bcrypt('cashierpassword123'),
            'username' => 'junilbiot',
            'address' => 'Cebu City',
            'phone' => '09123456789',
        ]);

        $cashier->assignRole('cashier');

        $admin = User::query()->create([
            'name' => 'Admin',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminpassword123'),
            'username' => 'admin',
            'address' => 'Cebu City',
            'phone' => '09123456789',
        ]);

        $admin->assignRole('admin');
    }
}
