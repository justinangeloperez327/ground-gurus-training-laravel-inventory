<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Since we need to run the seeder without firing the model events, we need to use the WithoutModelEvents trait.
        // Create roles
        if (Role::count() === 0) {
            $this->call(RoleSeeder::class);
        }

        $password = bcrypt('password');

        User::insert([
            [
                'first_name' => 'Ad',
                'last_name' => 'min',
                'email' => 'admin@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'Admin')->first()->id,
                'first_login' => false,
            ], [
                'first_name' => 'Inventory',
                'last_name' => 'Manager',
                'email' => 'inventory@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'Inventory Manager')->first()->id,
                'first_login' => false,
            ], [
                'first_name' => 'Procurement',
                'last_name' => 'Officer',
                'email' => 'procurement@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'Procurement Officer')->first()->id,
                'first_login' => false,
            ], [
                'first_name' => 'Warehouse',
                'last_name' => 'Staff',
                'email' => 'warehouse@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'Warehouse Staff')->first()->id,
                'first_login' => false,
            ], [
                'first_name' => 'Requester',
                'last_name' => '',
                'email' => 'requester@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'Requester')->first()->id,
                'first_login' => false,
            ],
        ]);
    }
}
