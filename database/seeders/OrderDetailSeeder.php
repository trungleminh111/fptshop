<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderDetails = [
            [1, 1,33830000 , 1],
            [2, 2,27480000 , 1],
            
        ];

        foreach ($orderDetails as $order) {
            OrderDetail::create([
                'order_id' => $order[0],
                'product_id' => $order[1],
                'price' => $order[2],
                'quantity' => $order[3],
            ]);
        }
    }
}
