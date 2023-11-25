<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = [
            [1,1,2],
            [1,10,3],
        ];

        foreach($carts as $cart){
            Cart::create([
                'user_id' => $cart[0],
                'product_id' => $cart[1],
                'quantity' => $cart[2],
            ]);
        }
    }
}
