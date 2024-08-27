<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'Inventory Manager'],
            ['name' => 'Procurement Officer'],
            ['name' => 'Warehouse Staff'],
            ['name' => 'Requester'],
        ]);
    }
}
