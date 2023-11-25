<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['Iphone 15','iphone-15.jpg', 33830000,123,'desc',0,2],
            ['Iphone 14','iphone-14.jpg', 27480000,123,'desc',0,2],
            ['Iphone 11','iphone-11.jpg', 10900000,123,'desc',0,2],
            ['Iphone 13','iphone-13.jpg', 16490000,123,'desc',0,2],
            ['Iphone 12','iphone-12.jpg', 13690000,123,'desc',0,2],
            ['Samsung Galaxy Z Fold5','samsung-galaxy-z-fold5.jpg', 31460000,123,'desc',0,2],
            ['Samsung Galaxy S23 Ultra','samsung-galaxy-s23-ultra.jpg', 22490000,123,'desc',0,2],
            ['Samsung Galaxy Z Flip4','samsung-galaxy-z-flip4.jpg', 12690000,123,'desc',0,2],

            ['MacBook Air 13 inch M1','macbook-air-m1.jpg', 18990000,123,'desc',0,1],
            ['MacBook Air 13 inch M2','apple-macbook-air-m2.jpg', 26990000,123,'desc',0,1],
            ['MacBook Pro 13 inch M2','apple-macbook-pro-13-inch-m2.jpg', 39980000,123,'desc',0,1],
            ['MacBook Pro 16 inch M2 Pro','macbook-pro-16-inch-m2.jpg', 56990000,123,'desc',0,1],
            ['Asus TUF Gaming F15','asus-tuf-gaming-f15.jpg', 15990000,123,'desc',0,1],
            ['Asus Vivobook Go 15','asus-vivobook-go-15.jpg', 13490000,123,'desc',0,1],
            ['Acer Aspire 5 Gaming','acer-aspire-5.jpg', 16990000,123,'desc',0,1],
            ['Acer Aspire 3','acer-aspire-3.jpg', 8490000,123,'desc',0,1],
            
            

        ];

        foreach($products as $pr){
            Product::create([
                'name' => $pr[0],
                'image' => $pr[1],
                'price' => $pr[2],
                'quantity' => $pr[3],
                'description' => $pr[4],
                'status' => $pr[5],
                'category_id' => $pr[6],
            ]);
        }
    }
}
