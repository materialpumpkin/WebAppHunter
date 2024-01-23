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
                'name' => '作業',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('categories')->insert([
                'name' => '趣味',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('categories')->insert([
                'name' => 'コミュニケーション',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'name' => 'ビジネス',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'name' => '学習',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'name' => 'エンタメ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'name' => 'ライフスタイル',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
        DB::table('categories')->insert([
                'name' => '情報',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
    }
}
