<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

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
                'first_name' => 'Admin',
                'last_name' => '',
                'email' => 'admin@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'admin')->first()->id,
            ], [
                'first_name' => 'Inventory Manager',
                'last_name' => '',
                'email' => 'inventory@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'inventory_manager')->first()->id,
            ], [
                'first_name' => 'Procurement Officer',
                'last_name' => '',
                'email' => 'procurement@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'procurement_officer')->first()->id,
            ], [
                'first_name' => 'Warehouse Staff',
                'last_name' => '',
                'email' => 'warehouse@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'warehouse_staff')->first()->id,
            ], [
                'first_name' => 'Requester',
                'last_name' => '',
                'email' => 'requester@gmail.com',
                'password' => $password,
                'role_id' => Role::where('name', 'requester')->first()->id,
            ]
        ]);
    }
}
