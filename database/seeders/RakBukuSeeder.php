<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RakBukuSeeder extends Seeder
{
    public function run()
    {
        DB::table('rak_bukus')->insert([
            ["id" => 23, "no_rak" => "1", "nama_rak" => "Mawar", "kapasitas_rak" => "100", "created_at" => "2024-09-22 05:56:16", "updated_at" => "2024-09-22 05:56:16"],
            ["id" => 24, "no_rak" => "2", "nama_rak" => "Melati", "kapasitas_rak" => "100", "created_at" => "2024-09-22 05:56:32", "updated_at" => "2024-09-22 05:56:32"]
        ]);
    }
}
