<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * php artisan db:seed --class=UserSeeder
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('12345678'),
                    'role_as' => 1,
                ],
                [
                    'name' => 'Trần Trọng Nghĩa',
                    'email' => 'Nghia@gmail.com',
                    'password' => Hash::make('12345678'),
                    'role_as' => 0,
                ],
                [
                    'name' => 'Nguyễn Hồng Phúc',
                    'email' => 'Phuc@gmail.com',
                    'password' => Hash::make('12345678'),
                    'role_as' => 0,
                ],
            ]
        );
    }
}
