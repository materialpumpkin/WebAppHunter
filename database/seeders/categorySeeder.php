<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class categorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
                'name' => '作業・ビジネス',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('categories')->insert([
                'name' => '趣味',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
}
