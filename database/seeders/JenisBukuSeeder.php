<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBukuSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenis_bukus')->insert([
            ["id" => 11, "name" => "Sejarah", "slug" => "sejarah", "created_at" => now(), "updated_at" => now()],
            ["id" => 12, "name" => "Dongeng", "slug" => "dongeng", "created_at" => now(), "updated_at" => now()],
            ["id" => 13, "name" => "Lara", "slug" => "lara", "created_at" => "2025-07-20 04:21:23", "updated_at" => "2025-07-20 04:21:23"]
        ]);
    }
}
