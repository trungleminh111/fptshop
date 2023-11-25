<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [1, 'Quảng trị', 'thfbvhjtncd', 1, 1],
            [1, 'Quảng trị', 'thfbvhjtncd', 1, 1],
        ];

        foreach ($orders as $order) {
            Order::create([
                'user_id' => $order[0],
                'address' => $order[1],
                'code' => $order[2],
                'payment_method' => $order[3],
                'status' => $order[4],
            ]);
        }
    }
}
