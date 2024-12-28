<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                [
                    'slug' => 'cho',
                    'name' => 'Chó',
                    'description' => 'Chó Việt Nam',
                    'image' => 'uploads/category/1683206764.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'meo',
                    'name' => 'Mèo',
                    'description' => 'Mèo Việt Nam',
                    'image' => 'uploads/category/1683206734.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'hamster',
                    'name' => 'Hamster',
                    'description' => 'Hamster Việt Nam',
                    'image' => 'uploads/category/1683206794.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'chuot',
                    'name' => 'Chuột',
                    'description' => 'Chuột Việt Nam',
                    'image' => 'uploads/category/1683206824.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'thu-cung-khac',
                    'name' => 'Thú cưng khác',
                    'description' => 'Thú cưng khác',
                    'image' => 'uploads/category/1683206854.jpg',
                    'status' => 1,
                ]
            ]
        );
    }
}
