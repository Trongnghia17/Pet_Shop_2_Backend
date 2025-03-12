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
                ['slug' => 'trang-tri', 'name' => 'Trang trí', 'description' => 'Danh mục quà trang trí', 'status' => 1],
                ['slug' => 'giang-sinh', 'name' => 'Giáng sinh', 'description' => 'Danh mục quà Giáng sinh', 'status' => 1],
                ['slug' => 'sinh-nhat', 'name' => 'Sinh nhật', 'description' => 'Danh mục quà sinh nhật', 'status' => 1],
                ['slug' => 'valentine', 'name' => 'Valentine', 'description' => 'Danh mục quà Valentine', 'status' => 1],
                ['slug' => 'tet', 'name' => 'Tết', 'description' => 'Danh mục quà Tết', 'status' => 1],
                ['slug' => 'trung-thu', 'name' => 'Trung thu', 'description' => 'Danh mục quà Trung thu', 'status' => 1],
                ['slug' => 'le-hoi', 'name' => 'Lễ hội', 'description' => 'Danh mục quà lễ hội', 'status' => 1],
                ['slug' => 'ky-niem', 'name' => 'Kỷ niệm', 'description' => 'Danh mục quà kỷ niệm', 'status' => 1],
                ['slug' => 'do-handmade', 'name' => 'Đồ handmade', 'description' => 'Danh mục quà handmade', 'status' => 1],
                ['slug' => 'do-luu-niem', 'name' => 'Đồ lưu niệm', 'description' => 'Danh mục quà lưu niệm', 'status' => 1],
            ]
        );
    }
}
