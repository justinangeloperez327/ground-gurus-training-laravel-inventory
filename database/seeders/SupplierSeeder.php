<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            [
                'name' => 'Intel',
                'email' => 'intel@gmail.com',
                'phone' => fake()->phoneNumber(),
            ],
            [
                'name' => 'AMD',
                'email' => 'amd@gmail.com',
                'phone' => fake()->phoneNumber(),
            ],
            [
                'name' => 'NVIDIA',
                'email' => 'nvidia@gmail.com',
                'phone' => fake()->phoneNumber(),
            ],
        ]);

        // Supplier::factory(100)->hasItems(5)->create();
    }
}
