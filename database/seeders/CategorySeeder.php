<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['Laptop','laptopcate.jpg', 0],
            ['Điện thoại','dienthoaicate.jpg', 0],
        ];

        foreach($categories as $cate){
            Category::create([
                'name' => $cate[0],
                'image' => $cate[1],
                'status' => $cate[2],
            ]);
        }
    }
}
