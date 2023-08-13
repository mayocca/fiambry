<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Order::factory()
            ->count(10)
            ->hasAttached(
                \App\Models\Product::factory()
                    ->count(3)
                    ->create(),
                ['user_id' => \App\Models\User::all()->random()->id]
            )
            ->create();
    }
}
