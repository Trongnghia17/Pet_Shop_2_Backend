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
//                [
//                    'slug' => 'meo-vang',
//                    'name' => 'Mèo vàng',
//                    'description' => 'Siêu đáng yêu',
//                    'image' => 'uploads/category/1735452922.jpg',
//                    'status' => 1,
//                ],
//                [
//                    'slug' => 'meo-den',
//                    'name' => 'Mèo đen',
//                    'description' => 'Anh quốc',
//                    'image' => 'uploads/category/1735452945.jpg',
//                    'status' => 1,
//                ],
//                [
//                    'slug' => 'meo-anh',
//                    'name' => 'Mèo anh',
//                    'description' => 'Mèo',
//                    'image' => 'uploads/category/1735453958.jpg',
//                    'status' => 1,
//                ],
//                [
//                    'slug' => 'meo-con',
//                    'name' => 'Mèo con',
//                    'description' => 'đáng yêu',
//                    'image' => 'uploads/category/1735453983.jpg',
//                    'status' => 1,
//                ],
//                [
//                    'slug' => 'meo-girl',
//                    'name' => 'Mèo girl',
//                    'description' => 'soft',
//                    'image' => 'uploads/category/1735454010.jpg',
//                    'status' => 1,
//                ],
//                [
//                    'slug' => 'meo-bao',
//                    'name' => 'Mèo báo',
//                    'description' => 'sleep',
//                    'image' => 'uploads/category/1735454033.jpg',
//                    'status' => 1,
//                ],
                [
                    'slug' => 'ga',
                    'name' => 'Gà',
                    'description' => 'Gà mái',
                    'image' => 'uploads/category/1735379440.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'chuot',
                    'name' => 'Chuột',
                    'description' => 'Chuột Việt Nam',
                    'image' => 'uploads/category/z6174808882377_46108520a400984a1700daf514911ab9.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'lon',
                    'name' => 'Lợn',
                    'description' => 'Lợn việt nam',
                    'image' => 'uploads/category/1735379778.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'ca',
                    'name' => 'cá ',
                    'description' => 'cá hề',
                    'image' => 'uploads/category/cahe.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'gau',
                    'name' => 'gấu  ',
                    'description' => 'gấu bắc cực',
                    'image' => 'uploads/category/1735380033.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'cu',
                    'name' => 'cú  ',
                    'description' => 'cú mèo',
                    'image' => 'uploads/category/1735380160.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'cao',
                    'name' => 'cáo ',
                    'description' => 'cáo hoang dã',
                    'image' => 'uploads/category/1735380244.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'huou',
                    'name' => 'hươu',
                    'description' => 'hươu sừng',
                    'image' => 'uploads/category/1735380317.jpg',
                    'status' => 1,
                ],
                [
                    'slug' => 'vit',
                    'name' => 'vịt trời',
                    'description' => 'vịt trời biết bay ',
                    'image' => 'uploads/category/1735379613.jpg',
                    'status' => 1,
                ]
            ]
        );
    }
}
