<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert(
            [
                [
                    'product_id' => 1,
                    'user_id' => 2,
                    'comment' => 'Quà này đẹp quá',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => 6,
                    'user_id' => 2,
                    'comment' => 'Mua đi các chế',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => 3,
                    'user_id' => 2,
                    'comment' => 'Đẹp quá shop ơi',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => 3,
                    'user_id' => 3,
                    'comment' => 'Quà này siêu cute',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => 4,
                    'user_id' => 2,
                    'comment' => 'Quà này đẹp quá',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => 5,
                    'user_id' => 2,
                    'comment' => 'Quà này đẹp quá',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
