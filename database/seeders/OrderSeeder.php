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
        \App\Models\Order::factory(10)
            ->create()
            ->each(function (\App\Models\Order $order) {
                $allowedProducts = \App\Models\Product::all()->random(rand(3, 7));

                $order->allowedProducts()->sync($allowedProducts);

                for ($i = 0; $i < rand(3, 7); $i++) {
                    $order->products()->attach(
                        $allowedProducts->random(),
                        [
                            'user_id' => \App\Models\User::all()->random()->id,
                            'quantity' => rand(1, 5),
                        ],
                    );
                }
            });
    }
}
