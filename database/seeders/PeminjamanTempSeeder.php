<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanTempSeeder extends Seeder
{
    public function run()
    {
        DB::table('peminjaman_temp')->insert([
            ["id" => 180, "isbn" => "978-602-453-048-85", "judul" => "SEJARAH", "jumlah" => "8", "created_at" => null, "updated_at" => null]
        ]);
    }
}
