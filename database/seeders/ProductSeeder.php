<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];

        for ($i = 1; $i <= 40; $i++) {
            $original_price = rand(60000, 6000000);
            $selling_price = rand(50000, $original_price); // Đảm bảo selling_price <= original_price

            $products[] = [
                'category_id' => rand(1, 10),
                'slug' => 'qua-' . $i,
                'name' => 'Quà ' . $i,
                'description' => 'Mô tả cho quà ' . $i,
                'brand' => 'Thương hiệu ' . $i,
                'selling_price' => $selling_price,
                'original_price' => $original_price,
                'quantity' => rand(1, 100),
                'image' => 'uploads/product/' . $i . '.jpg',
                'featured' => rand(0, 1),
                'status' => 1,
                'count' => rand(1, 20),
            ];
        }


        DB::table('products')->insert($products);
    }
}
